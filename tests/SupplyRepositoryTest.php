<?php

use App\Models\Supply;
use App\Repositories\SupplyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SupplyRepositoryTest extends TestCase
{
    use MakeSupplyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SupplyRepository
     */
    protected $supplyRepo;

    public function setUp()
    {
        parent::setUp();
        $this->supplyRepo = App::make(SupplyRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSupply()
    {
        $supply = $this->fakeSupplyData();
        $createdSupply = $this->supplyRepo->create($supply);
        $createdSupply = $createdSupply->toArray();
        $this->assertArrayHasKey('id', $createdSupply);
        $this->assertNotNull($createdSupply['id'], 'Created Supply must have id specified');
        $this->assertNotNull(Supply::find($createdSupply['id']), 'Supply with given id must be in DB');
        $this->assertModelData($supply, $createdSupply);
    }

    /**
     * @test read
     */
    public function testReadSupply()
    {
        $supply = $this->makeSupply();
        $dbSupply = $this->supplyRepo->find($supply->id);
        $dbSupply = $dbSupply->toArray();
        $this->assertModelData($supply->toArray(), $dbSupply);
    }

    /**
     * @test update
     */
    public function testUpdateSupply()
    {
        $supply = $this->makeSupply();
        $fakeSupply = $this->fakeSupplyData();
        $updatedSupply = $this->supplyRepo->update($fakeSupply, $supply->id);
        $this->assertModelData($fakeSupply, $updatedSupply->toArray());
        $dbSupply = $this->supplyRepo->find($supply->id);
        $this->assertModelData($fakeSupply, $dbSupply->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSupply()
    {
        $supply = $this->makeSupply();
        $resp = $this->supplyRepo->delete($supply->id);
        $this->assertTrue($resp);
        $this->assertNull(Supply::find($supply->id), 'Supply should not exist in DB');
    }
}
