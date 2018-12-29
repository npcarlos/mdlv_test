<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SupplyOrderItemApiTest extends TestCase
{
    use MakeSupplyOrderItemTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSupplyOrderItem()
    {
        $supplyOrderItem = $this->fakeSupplyOrderItemData();
        $this->json('POST', '/api/v1/supplyOrderItems', $supplyOrderItem);

        $this->assertApiResponse($supplyOrderItem);
    }

    /**
     * @test
     */
    public function testReadSupplyOrderItem()
    {
        $supplyOrderItem = $this->makeSupplyOrderItem();
        $this->json('GET', '/api/v1/supplyOrderItems/'.$supplyOrderItem->id);

        $this->assertApiResponse($supplyOrderItem->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSupplyOrderItem()
    {
        $supplyOrderItem = $this->makeSupplyOrderItem();
        $editedSupplyOrderItem = $this->fakeSupplyOrderItemData();

        $this->json('PUT', '/api/v1/supplyOrderItems/'.$supplyOrderItem->id, $editedSupplyOrderItem);

        $this->assertApiResponse($editedSupplyOrderItem);
    }

    /**
     * @test
     */
    public function testDeleteSupplyOrderItem()
    {
        $supplyOrderItem = $this->makeSupplyOrderItem();
        $this->json('DELETE', '/api/v1/supplyOrderItems/'.$supplyOrderItem->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/supplyOrderItems/'.$supplyOrderItem->id);

        $this->assertResponseStatus(404);
    }
}
