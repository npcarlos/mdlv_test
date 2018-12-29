<?php

use App\Models\SupplyOrderItem;
use App\Repositories\SupplyOrderItemRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SupplyOrderItemRepositoryTest extends TestCase
{
    use MakeSupplyOrderItemTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SupplyOrderItemRepository
     */
    protected $supplyOrderItemRepo;

    public function setUp()
    {
        parent::setUp();
        $this->supplyOrderItemRepo = App::make(SupplyOrderItemRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSupplyOrderItem()
    {
        $supplyOrderItem = $this->fakeSupplyOrderItemData();
        $createdSupplyOrderItem = $this->supplyOrderItemRepo->create($supplyOrderItem);
        $createdSupplyOrderItem = $createdSupplyOrderItem->toArray();
        $this->assertArrayHasKey('id', $createdSupplyOrderItem);
        $this->assertNotNull($createdSupplyOrderItem['id'], 'Created SupplyOrderItem must have id specified');
        $this->assertNotNull(SupplyOrderItem::find($createdSupplyOrderItem['id']), 'SupplyOrderItem with given id must be in DB');
        $this->assertModelData($supplyOrderItem, $createdSupplyOrderItem);
    }

    /**
     * @test read
     */
    public function testReadSupplyOrderItem()
    {
        $supplyOrderItem = $this->makeSupplyOrderItem();
        $dbSupplyOrderItem = $this->supplyOrderItemRepo->find($supplyOrderItem->id);
        $dbSupplyOrderItem = $dbSupplyOrderItem->toArray();
        $this->assertModelData($supplyOrderItem->toArray(), $dbSupplyOrderItem);
    }

    /**
     * @test update
     */
    public function testUpdateSupplyOrderItem()
    {
        $supplyOrderItem = $this->makeSupplyOrderItem();
        $fakeSupplyOrderItem = $this->fakeSupplyOrderItemData();
        $updatedSupplyOrderItem = $this->supplyOrderItemRepo->update($fakeSupplyOrderItem, $supplyOrderItem->id);
        $this->assertModelData($fakeSupplyOrderItem, $updatedSupplyOrderItem->toArray());
        $dbSupplyOrderItem = $this->supplyOrderItemRepo->find($supplyOrderItem->id);
        $this->assertModelData($fakeSupplyOrderItem, $dbSupplyOrderItem->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSupplyOrderItem()
    {
        $supplyOrderItem = $this->makeSupplyOrderItem();
        $resp = $this->supplyOrderItemRepo->delete($supplyOrderItem->id);
        $this->assertTrue($resp);
        $this->assertNull(SupplyOrderItem::find($supplyOrderItem->id), 'SupplyOrderItem should not exist in DB');
    }
}
