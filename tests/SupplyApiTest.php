<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SupplyApiTest extends TestCase
{
    use MakeSupplyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSupply()
    {
        $supply = $this->fakeSupplyData();
        $this->json('POST', '/api/v1/supplies', $supply);

        $this->assertApiResponse($supply);
    }

    /**
     * @test
     */
    public function testReadSupply()
    {
        $supply = $this->makeSupply();
        $this->json('GET', '/api/v1/supplies/'.$supply->id);

        $this->assertApiResponse($supply->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSupply()
    {
        $supply = $this->makeSupply();
        $editedSupply = $this->fakeSupplyData();

        $this->json('PUT', '/api/v1/supplies/'.$supply->id, $editedSupply);

        $this->assertApiResponse($editedSupply);
    }

    /**
     * @test
     */
    public function testDeleteSupply()
    {
        $supply = $this->makeSupply();
        $this->json('DELETE', '/api/v1/supplies/'.$supply->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/supplies/'.$supply->id);

        $this->assertResponseStatus(404);
    }
}
