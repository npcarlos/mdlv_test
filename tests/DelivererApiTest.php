<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DelivererApiTest extends TestCase
{
    use MakeDelivererTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDeliverer()
    {
        $deliverer = $this->fakeDelivererData();
        $this->json('POST', '/api/v1/deliverers', $deliverer);

        $this->assertApiResponse($deliverer);
    }

    /**
     * @test
     */
    public function testReadDeliverer()
    {
        $deliverer = $this->makeDeliverer();
        $this->json('GET', '/api/v1/deliverers/'.$deliverer->id);

        $this->assertApiResponse($deliverer->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDeliverer()
    {
        $deliverer = $this->makeDeliverer();
        $editedDeliverer = $this->fakeDelivererData();

        $this->json('PUT', '/api/v1/deliverers/'.$deliverer->id, $editedDeliverer);

        $this->assertApiResponse($editedDeliverer);
    }

    /**
     * @test
     */
    public function testDeleteDeliverer()
    {
        $deliverer = $this->makeDeliverer();
        $this->json('DELETE', '/api/v1/deliverers/'.$deliverer->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/deliverers/'.$deliverer->id);

        $this->assertResponseStatus(404);
    }
}
