<?php

use App\Models\MeasurementUnit;
use App\Repositories\MeasurementUnitRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MeasurementUnitRepositoryTest extends TestCase
{
    use MakeMeasurementUnitTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MeasurementUnitRepository
     */
    protected $measurementUnitRepo;

    public function setUp()
    {
        parent::setUp();
        $this->measurementUnitRepo = App::make(MeasurementUnitRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMeasurementUnit()
    {
        $measurementUnit = $this->fakeMeasurementUnitData();
        $createdMeasurementUnit = $this->measurementUnitRepo->create($measurementUnit);
        $createdMeasurementUnit = $createdMeasurementUnit->toArray();
        $this->assertArrayHasKey('id', $createdMeasurementUnit);
        $this->assertNotNull($createdMeasurementUnit['id'], 'Created MeasurementUnit must have id specified');
        $this->assertNotNull(MeasurementUnit::find($createdMeasurementUnit['id']), 'MeasurementUnit with given id must be in DB');
        $this->assertModelData($measurementUnit, $createdMeasurementUnit);
    }

    /**
     * @test read
     */
    public function testReadMeasurementUnit()
    {
        $measurementUnit = $this->makeMeasurementUnit();
        $dbMeasurementUnit = $this->measurementUnitRepo->find($measurementUnit->id);
        $dbMeasurementUnit = $dbMeasurementUnit->toArray();
        $this->assertModelData($measurementUnit->toArray(), $dbMeasurementUnit);
    }

    /**
     * @test update
     */
    public function testUpdateMeasurementUnit()
    {
        $measurementUnit = $this->makeMeasurementUnit();
        $fakeMeasurementUnit = $this->fakeMeasurementUnitData();
        $updatedMeasurementUnit = $this->measurementUnitRepo->update($fakeMeasurementUnit, $measurementUnit->id);
        $this->assertModelData($fakeMeasurementUnit, $updatedMeasurementUnit->toArray());
        $dbMeasurementUnit = $this->measurementUnitRepo->find($measurementUnit->id);
        $this->assertModelData($fakeMeasurementUnit, $dbMeasurementUnit->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMeasurementUnit()
    {
        $measurementUnit = $this->makeMeasurementUnit();
        $resp = $this->measurementUnitRepo->delete($measurementUnit->id);
        $this->assertTrue($resp);
        $this->assertNull(MeasurementUnit::find($measurementUnit->id), 'MeasurementUnit should not exist in DB');
    }
}
