<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PrelotOrderApiTest extends TestCase
{
    use MakePrelotOrderTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePrelotOrder()
    {
        $prelotOrder = $this->fakePrelotOrderData();
        $this->json('POST', '/api/v1/prelotOrders', $prelotOrder);

        $this->assertApiResponse($prelotOrder);
    }

    /**
     * @test
     */
    public function testReadPrelotOrder()
    {
        $prelotOrder = $this->makePrelotOrder();
        $this->json('GET', '/api/v1/prelotOrders/'.$prelotOrder->id);

        $this->assertApiResponse($prelotOrder->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePrelotOrder()
    {
        $prelotOrder = $this->makePrelotOrder();
        $editedPrelotOrder = $this->fakePrelotOrderData();

        $this->json('PUT', '/api/v1/prelotOrders/'.$prelotOrder->id, $editedPrelotOrder);

        $this->assertApiResponse($editedPrelotOrder);
    }

    /**
     * @test
     */
    public function testDeletePrelotOrder()
    {
        $prelotOrder = $this->makePrelotOrder();
        $this->json('DELETE', '/api/v1/prelotOrders/'.$prelotOrder->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/prelotOrders/'.$prelotOrder->id);

        $this->assertResponseStatus(404);
    }
}
