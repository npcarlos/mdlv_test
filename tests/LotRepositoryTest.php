<?php

use App\Models\Lot;
use App\Repositories\LotRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LotRepositoryTest extends TestCase
{
    use MakeLotTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LotRepository
     */
    protected $lotRepo;

    public function setUp()
    {
        parent::setUp();
        $this->lotRepo = App::make(LotRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateLot()
    {
        $lot = $this->fakeLotData();
        $createdLot = $this->lotRepo->create($lot);
        $createdLot = $createdLot->toArray();
        $this->assertArrayHasKey('id', $createdLot);
        $this->assertNotNull($createdLot['id'], 'Created Lot must have id specified');
        $this->assertNotNull(Lot::find($createdLot['id']), 'Lot with given id must be in DB');
        $this->assertModelData($lot, $createdLot);
    }

    /**
     * @test read
     */
    public function testReadLot()
    {
        $lot = $this->makeLot();
        $dbLot = $this->lotRepo->find($lot->id);
        $dbLot = $dbLot->toArray();
        $this->assertModelData($lot->toArray(), $dbLot);
    }

    /**
     * @test update
     */
    public function testUpdateLot()
    {
        $lot = $this->makeLot();
        $fakeLot = $this->fakeLotData();
        $updatedLot = $this->lotRepo->update($fakeLot, $lot->id);
        $this->assertModelData($fakeLot, $updatedLot->toArray());
        $dbLot = $this->lotRepo->find($lot->id);
        $this->assertModelData($fakeLot, $dbLot->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteLot()
    {
        $lot = $this->makeLot();
        $resp = $this->lotRepo->delete($lot->id);
        $this->assertTrue($resp);
        $this->assertNull(Lot::find($lot->id), 'Lot should not exist in DB');
    }
}
