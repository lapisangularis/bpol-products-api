<?php

declare(strict_types=1);

namespace App\Tests\Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductControllerTest extends AbstractControllerTest
{
    public function testPost_ProductData_ProductCreated(): void
    {
        $requestData = [
            'name' => 'Test product',
            'price' => 1234,
        ];

        $this->sendRequest('/product', Request::METHOD_POST, $requestData);
        $this->assertEquals(Response::HTTP_CREATED, self::$client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('id', $this->getDecodedResponseData());
        $this->assertArrayHasKey('name', $this->getDecodedResponseData());
        $this->assertArrayHasKey('price', $this->getDecodedResponseData());
    }
}
