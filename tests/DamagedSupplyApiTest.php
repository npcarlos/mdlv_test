<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DamagedSupplyApiTest extends TestCase
{
    use MakeDamagedSupplyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDamagedSupply()
    {
        $damagedSupply = $this->fakeDamagedSupplyData();
        $this->json('POST', '/api/v1/damagedSupplies', $damagedSupply);

        $this->assertApiResponse($damagedSupply);
    }

    /**
     * @test
     */
    public function testReadDamagedSupply()
    {
        $damagedSupply = $this->makeDamagedSupply();
        $this->json('GET', '/api/v1/damagedSupplies/'.$damagedSupply->id);

        $this->assertApiResponse($damagedSupply->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDamagedSupply()
    {
        $damagedSupply = $this->makeDamagedSupply();
        $editedDamagedSupply = $this->fakeDamagedSupplyData();

        $this->json('PUT', '/api/v1/damagedSupplies/'.$damagedSupply->id, $editedDamagedSupply);

        $this->assertApiResponse($editedDamagedSupply);
    }

    /**
     * @test
     */
    public function testDeleteDamagedSupply()
    {
        $damagedSupply = $this->makeDamagedSupply();
        $this->json('DELETE', '/api/v1/damagedSupplies/'.$damagedSupply->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/damagedSupplies/'.$damagedSupply->id);

        $this->assertResponseStatus(404);
    }
}
