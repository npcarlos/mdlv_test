<?php

use App\Models\SupplyCategory;
use App\Repositories\SupplyCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SupplyCategoryRepositoryTest extends TestCase
{
    use MakeSupplyCategoryTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SupplyCategoryRepository
     */
    protected $supplyCategoryRepo;

    public function setUp()
    {
        parent::setUp();
        $this->supplyCategoryRepo = App::make(SupplyCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSupplyCategory()
    {
        $supplyCategory = $this->fakeSupplyCategoryData();
        $createdSupplyCategory = $this->supplyCategoryRepo->create($supplyCategory);
        $createdSupplyCategory = $createdSupplyCategory->toArray();
        $this->assertArrayHasKey('id', $createdSupplyCategory);
        $this->assertNotNull($createdSupplyCategory['id'], 'Created SupplyCategory must have id specified');
        $this->assertNotNull(SupplyCategory::find($createdSupplyCategory['id']), 'SupplyCategory with given id must be in DB');
        $this->assertModelData($supplyCategory, $createdSupplyCategory);
    }

    /**
     * @test read
     */
    public function testReadSupplyCategory()
    {
        $supplyCategory = $this->makeSupplyCategory();
        $dbSupplyCategory = $this->supplyCategoryRepo->find($supplyCategory->id);
        $dbSupplyCategory = $dbSupplyCategory->toArray();
        $this->assertModelData($supplyCategory->toArray(), $dbSupplyCategory);
    }

    /**
     * @test update
     */
    public function testUpdateSupplyCategory()
    {
        $supplyCategory = $this->makeSupplyCategory();
        $fakeSupplyCategory = $this->fakeSupplyCategoryData();
        $updatedSupplyCategory = $this->supplyCategoryRepo->update($fakeSupplyCategory, $supplyCategory->id);
        $this->assertModelData($fakeSupplyCategory, $updatedSupplyCategory->toArray());
        $dbSupplyCategory = $this->supplyCategoryRepo->find($supplyCategory->id);
        $this->assertModelData($fakeSupplyCategory, $dbSupplyCategory->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSupplyCategory()
    {
        $supplyCategory = $this->makeSupplyCategory();
        $resp = $this->supplyCategoryRepo->delete($supplyCategory->id);
        $this->assertTrue($resp);
        $this->assertNull(SupplyCategory::find($supplyCategory->id), 'SupplyCategory should not exist in DB');
    }
}
