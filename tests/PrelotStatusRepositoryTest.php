<?php

use App\Models\PrelotStatus;
use App\Repositories\PrelotStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PrelotStatusRepositoryTest extends TestCase
{
    use MakePrelotStatusTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PrelotStatusRepository
     */
    protected $prelotStatusRepo;

    public function setUp()
    {
        parent::setUp();
        $this->prelotStatusRepo = App::make(PrelotStatusRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePrelotStatus()
    {
        $prelotStatus = $this->fakePrelotStatusData();
        $createdPrelotStatus = $this->prelotStatusRepo->create($prelotStatus);
        $createdPrelotStatus = $createdPrelotStatus->toArray();
        $this->assertArrayHasKey('id', $createdPrelotStatus);
        $this->assertNotNull($createdPrelotStatus['id'], 'Created PrelotStatus must have id specified');
        $this->assertNotNull(PrelotStatus::find($createdPrelotStatus['id']), 'PrelotStatus with given id must be in DB');
        $this->assertModelData($prelotStatus, $createdPrelotStatus);
    }

    /**
     * @test read
     */
    public function testReadPrelotStatus()
    {
        $prelotStatus = $this->makePrelotStatus();
        $dbPrelotStatus = $this->prelotStatusRepo->find($prelotStatus->id);
        $dbPrelotStatus = $dbPrelotStatus->toArray();
        $this->assertModelData($prelotStatus->toArray(), $dbPrelotStatus);
    }

    /**
     * @test update
     */
    public function testUpdatePrelotStatus()
    {
        $prelotStatus = $this->makePrelotStatus();
        $fakePrelotStatus = $this->fakePrelotStatusData();
        $updatedPrelotStatus = $this->prelotStatusRepo->update($fakePrelotStatus, $prelotStatus->id);
        $this->assertModelData($fakePrelotStatus, $updatedPrelotStatus->toArray());
        $dbPrelotStatus = $this->prelotStatusRepo->find($prelotStatus->id);
        $this->assertModelData($fakePrelotStatus, $dbPrelotStatus->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePrelotStatus()
    {
        $prelotStatus = $this->makePrelotStatus();
        $resp = $this->prelotStatusRepo->delete($prelotStatus->id);
        $this->assertTrue($resp);
        $this->assertNull(PrelotStatus::find($prelotStatus->id), 'PrelotStatus should not exist in DB');
    }
}
