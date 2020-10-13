<?php

declare(strict_types=1);

namespace App\Tests\Application\Controller;

use App\Tests\Application\AbstractFixturesTest;
use Symfony\Component\HttpClient\HttpClient as Client;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractControllerTest extends AbstractFixturesTest
{
    /**
     * @var Client
     */
    protected static $client;

    protected $apiPrefix;

    public function setUp(): void
    {
        self::$client = self::createClient();
        parent::setUp();
    }

    protected function sendRequest(string $uri, string $method = Request::METHOD_GET, array $content = []): void
    {
        self::$client->request(
            $method,
            $uri,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($content)
        );
    }

    protected function getDecodedResponseData($asArray = true)
    {
        $decodedResponse = $this->getDecodedResponse($asArray);

        return $asArray ? $decodedResponse['data'] : $decodedResponse->data;
    }

    protected function getDecodedResponse($asArray = false)
    {
        return json_decode(self::$client->getResponse()->getContent(), $asArray);
    }
}
