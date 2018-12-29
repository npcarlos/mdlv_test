<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeliveryStatusApiTest extends TestCase
{
    use MakeDeliveryStatusTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDeliveryStatus()
    {
        $deliveryStatus = $this->fakeDeliveryStatusData();
        $this->json('POST', '/api/v1/deliveryStatuses', $deliveryStatus);

        $this->assertApiResponse($deliveryStatus);
    }

    /**
     * @test
     */
    public function testReadDeliveryStatus()
    {
        $deliveryStatus = $this->makeDeliveryStatus();
        $this->json('GET', '/api/v1/deliveryStatuses/'.$deliveryStatus->id);

        $this->assertApiResponse($deliveryStatus->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDeliveryStatus()
    {
        $deliveryStatus = $this->makeDeliveryStatus();
        $editedDeliveryStatus = $this->fakeDeliveryStatusData();

        $this->json('PUT', '/api/v1/deliveryStatuses/'.$deliveryStatus->id, $editedDeliveryStatus);

        $this->assertApiResponse($editedDeliveryStatus);
    }

    /**
     * @test
     */
    public function testDeleteDeliveryStatus()
    {
        $deliveryStatus = $this->makeDeliveryStatus();
        $this->json('DELETE', '/api/v1/deliveryStatuses/'.$deliveryStatus->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/deliveryStatuses/'.$deliveryStatus->id);

        $this->assertResponseStatus(404);
    }
}
