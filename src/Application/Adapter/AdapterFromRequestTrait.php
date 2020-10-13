<?php

declare(strict_types=1);

namespace App\Application\Adapter;

use App\Application\Annotation\QueryParamType;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;
use Symfony\Component\HttpFoundation\Request;

trait AdapterFromRequestTrait
{
    public static function createFromRequest(Request $request)
    {
        $reflection = new ReflectionClass(self::class);

        $propertiesBag = self::getPropertiesFromRequest($request);
        $parameters = self::prepareParametersForConstructor($propertiesBag, $reflection);

        return $reflection->newInstanceArgs($parameters);
    }

    protected static function getPropertiesFromRequest(Request $request): array
    {
        return array_merge(
            json_decode($request->getContent(), true) ?: [],
            $request->attributes->get('_route_params')
        );
    }

    protected static function prepareParametersForConstructor(array $propertiesBag, ReflectionClass $reflectionClass): array
    {
        $parametersSchema = $reflectionClass->getConstructor()->getParameters();

        $parameters = [];

        foreach ($parametersSchema as $param) {
            if (array_key_exists($param->getName(), $propertiesBag)) {
                $value = $propertiesBag[$param->getName()];
                self::parseTypeByAnnotationIfAvailable($reflectionClass->getProperty($param->getName()), $value);
                $parameters[] = $value;
            } elseif ($param->isDefaultValueAvailable()) {
                $parameters[] = $param->getDefaultValue();
            }
        }

        return $parameters;
    }

    private static function parseTypeByAnnotationIfAvailable(\ReflectionProperty $property, &$value): void
    {
        if (is_null($value)) {
            return;
        }

        $annotationReader = new AnnotationReader();

        $typeAnnotation = $annotationReader->getPropertyAnnotation($property, QueryParamType::class);

        if ($typeAnnotation) {
            settype($value, $typeAnnotation->type);
        }
    }
}
