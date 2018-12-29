<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeliveryAddressApiTest extends TestCase
{
    use MakeDeliveryAddressTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDeliveryAddress()
    {
        $deliveryAddress = $this->fakeDeliveryAddressData();
        $this->json('POST', '/api/v1/deliveryAddresses', $deliveryAddress);

        $this->assertApiResponse($deliveryAddress);
    }

    /**
     * @test
     */
    public function testReadDeliveryAddress()
    {
        $deliveryAddress = $this->makeDeliveryAddress();
        $this->json('GET', '/api/v1/deliveryAddresses/'.$deliveryAddress->id);

        $this->assertApiResponse($deliveryAddress->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDeliveryAddress()
    {
        $deliveryAddress = $this->makeDeliveryAddress();
        $editedDeliveryAddress = $this->fakeDeliveryAddressData();

        $this->json('PUT', '/api/v1/deliveryAddresses/'.$deliveryAddress->id, $editedDeliveryAddress);

        $this->assertApiResponse($editedDeliveryAddress);
    }

    /**
     * @test
     */
    public function testDeleteDeliveryAddress()
    {
        $deliveryAddress = $this->makeDeliveryAddress();
        $this->json('DELETE', '/api/v1/deliveryAddresses/'.$deliveryAddress->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/deliveryAddresses/'.$deliveryAddress->id);

        $this->assertResponseStatus(404);
    }
}
