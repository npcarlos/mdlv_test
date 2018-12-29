<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SupplyOrderApiTest extends TestCase
{
    use MakeSupplyOrderTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSupplyOrder()
    {
        $supplyOrder = $this->fakeSupplyOrderData();
        $this->json('POST', '/api/v1/supplyOrders', $supplyOrder);

        $this->assertApiResponse($supplyOrder);
    }

    /**
     * @test
     */
    public function testReadSupplyOrder()
    {
        $supplyOrder = $this->makeSupplyOrder();
        $this->json('GET', '/api/v1/supplyOrders/'.$supplyOrder->id);

        $this->assertApiResponse($supplyOrder->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSupplyOrder()
    {
        $supplyOrder = $this->makeSupplyOrder();
        $editedSupplyOrder = $this->fakeSupplyOrderData();

        $this->json('PUT', '/api/v1/supplyOrders/'.$supplyOrder->id, $editedSupplyOrder);

        $this->assertApiResponse($editedSupplyOrder);
    }

    /**
     * @test
     */
    public function testDeleteSupplyOrder()
    {
        $supplyOrder = $this->makeSupplyOrder();
        $this->json('DELETE', '/api/v1/supplyOrders/'.$supplyOrder->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/supplyOrders/'.$supplyOrder->id);

        $this->assertResponseStatus(404);
    }
}
