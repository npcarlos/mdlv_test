<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LotApiTest extends TestCase
{
    use MakeLotTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateLot()
    {
        $lot = $this->fakeLotData();
        $this->json('POST', '/api/v1/lots', $lot);

        $this->assertApiResponse($lot);
    }

    /**
     * @test
     */
    public function testReadLot()
    {
        $lot = $this->makeLot();
        $this->json('GET', '/api/v1/lots/'.$lot->id);

        $this->assertApiResponse($lot->toArray());
    }

    /**
     * @test
     */
    public function testUpdateLot()
    {
        $lot = $this->makeLot();
        $editedLot = $this->fakeLotData();

        $this->json('PUT', '/api/v1/lots/'.$lot->id, $editedLot);

        $this->assertApiResponse($editedLot);
    }

    /**
     * @test
     */
    public function testDeleteLot()
    {
        $lot = $this->makeLot();
        $this->json('DELETE', '/api/v1/lots/'.$lot->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/lots/'.$lot->id);

        $this->assertResponseStatus(404);
    }
}
