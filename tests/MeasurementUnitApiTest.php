<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MeasurementUnitApiTest extends TestCase
{
    use MakeMeasurementUnitTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMeasurementUnit()
    {
        $measurementUnit = $this->fakeMeasurementUnitData();
        $this->json('POST', '/api/v1/measurementUnits', $measurementUnit);

        $this->assertApiResponse($measurementUnit);
    }

    /**
     * @test
     */
    public function testReadMeasurementUnit()
    {
        $measurementUnit = $this->makeMeasurementUnit();
        $this->json('GET', '/api/v1/measurementUnits/'.$measurementUnit->id);

        $this->assertApiResponse($measurementUnit->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMeasurementUnit()
    {
        $measurementUnit = $this->makeMeasurementUnit();
        $editedMeasurementUnit = $this->fakeMeasurementUnitData();

        $this->json('PUT', '/api/v1/measurementUnits/'.$measurementUnit->id, $editedMeasurementUnit);

        $this->assertApiResponse($editedMeasurementUnit);
    }

    /**
     * @test
     */
    public function testDeleteMeasurementUnit()
    {
        $measurementUnit = $this->makeMeasurementUnit();
        $this->json('DELETE', '/api/v1/measurementUnits/'.$measurementUnit->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/measurementUnits/'.$measurementUnit->id);

        $this->assertResponseStatus(404);
    }
}
