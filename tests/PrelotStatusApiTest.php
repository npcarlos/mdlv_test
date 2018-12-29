<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PrelotStatusApiTest extends TestCase
{
    use MakePrelotStatusTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePrelotStatus()
    {
        $prelotStatus = $this->fakePrelotStatusData();
        $this->json('POST', '/api/v1/prelotStatuses', $prelotStatus);

        $this->assertApiResponse($prelotStatus);
    }

    /**
     * @test
     */
    public function testReadPrelotStatus()
    {
        $prelotStatus = $this->makePrelotStatus();
        $this->json('GET', '/api/v1/prelotStatuses/'.$prelotStatus->id);

        $this->assertApiResponse($prelotStatus->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePrelotStatus()
    {
        $prelotStatus = $this->makePrelotStatus();
        $editedPrelotStatus = $this->fakePrelotStatusData();

        $this->json('PUT', '/api/v1/prelotStatuses/'.$prelotStatus->id, $editedPrelotStatus);

        $this->assertApiResponse($editedPrelotStatus);
    }

    /**
     * @test
     */
    public function testDeletePrelotStatus()
    {
        $prelotStatus = $this->makePrelotStatus();
        $this->json('DELETE', '/api/v1/prelotStatuses/'.$prelotStatus->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/prelotStatuses/'.$prelotStatus->id);

        $this->assertResponseStatus(404);
    }
}
