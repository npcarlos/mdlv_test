<?php

use App\Models\DamagedSupply;
use App\Repositories\DamagedSupplyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DamagedSupplyRepositoryTest extends TestCase
{
    use MakeDamagedSupplyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DamagedSupplyRepository
     */
    protected $damagedSupplyRepo;

    public function setUp()
    {
        parent::setUp();
        $this->damagedSupplyRepo = App::make(DamagedSupplyRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDamagedSupply()
    {
        $damagedSupply = $this->fakeDamagedSupplyData();
        $createdDamagedSupply = $this->damagedSupplyRepo->create($damagedSupply);
        $createdDamagedSupply = $createdDamagedSupply->toArray();
        $this->assertArrayHasKey('id', $createdDamagedSupply);
        $this->assertNotNull($createdDamagedSupply['id'], 'Created DamagedSupply must have id specified');
        $this->assertNotNull(DamagedSupply::find($createdDamagedSupply['id']), 'DamagedSupply with given id must be in DB');
        $this->assertModelData($damagedSupply, $createdDamagedSupply);
    }

    /**
     * @test read
     */
    public function testReadDamagedSupply()
    {
        $damagedSupply = $this->makeDamagedSupply();
        $dbDamagedSupply = $this->damagedSupplyRepo->find($damagedSupply->id);
        $dbDamagedSupply = $dbDamagedSupply->toArray();
        $this->assertModelData($damagedSupply->toArray(), $dbDamagedSupply);
    }

    /**
     * @test update
     */
    public function testUpdateDamagedSupply()
    {
        $damagedSupply = $this->makeDamagedSupply();
        $fakeDamagedSupply = $this->fakeDamagedSupplyData();
        $updatedDamagedSupply = $this->damagedSupplyRepo->update($fakeDamagedSupply, $damagedSupply->id);
        $this->assertModelData($fakeDamagedSupply, $updatedDamagedSupply->toArray());
        $dbDamagedSupply = $this->damagedSupplyRepo->find($damagedSupply->id);
        $this->assertModelData($fakeDamagedSupply, $dbDamagedSupply->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDamagedSupply()
    {
        $damagedSupply = $this->makeDamagedSupply();
        $resp = $this->damagedSupplyRepo->delete($damagedSupply->id);
        $this->assertTrue($resp);
        $this->assertNull(DamagedSupply::find($damagedSupply->id), 'DamagedSupply should not exist in DB');
    }
}
