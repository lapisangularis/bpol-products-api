<?php

declare(strict_types=1);

namespace App\Tests\Application\Controller;

use App\Tests\Application\AbstractFixturesTest;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractControllerTest extends WebTestCase
{
    protected static KernelBrowser $client;

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

    private function getDecodedResponse($asArray = false)
    {
        return json_decode(self::$client->getResponse()->getContent(), $asArray);
    }
}
