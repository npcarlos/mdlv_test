<?php

use App\Models\SupplyOrder;
use App\Repositories\SupplyOrderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SupplyOrderRepositoryTest extends TestCase
{
    use MakeSupplyOrderTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SupplyOrderRepository
     */
    protected $supplyOrderRepo;

    public function setUp()
    {
        parent::setUp();
        $this->supplyOrderRepo = App::make(SupplyOrderRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSupplyOrder()
    {
        $supplyOrder = $this->fakeSupplyOrderData();
        $createdSupplyOrder = $this->supplyOrderRepo->create($supplyOrder);
        $createdSupplyOrder = $createdSupplyOrder->toArray();
        $this->assertArrayHasKey('id', $createdSupplyOrder);
        $this->assertNotNull($createdSupplyOrder['id'], 'Created SupplyOrder must have id specified');
        $this->assertNotNull(SupplyOrder::find($createdSupplyOrder['id']), 'SupplyOrder with given id must be in DB');
        $this->assertModelData($supplyOrder, $createdSupplyOrder);
    }

    /**
     * @test read
     */
    public function testReadSupplyOrder()
    {
        $supplyOrder = $this->makeSupplyOrder();
        $dbSupplyOrder = $this->supplyOrderRepo->find($supplyOrder->id);
        $dbSupplyOrder = $dbSupplyOrder->toArray();
        $this->assertModelData($supplyOrder->toArray(), $dbSupplyOrder);
    }

    /**
     * @test update
     */
    public function testUpdateSupplyOrder()
    {
        $supplyOrder = $this->makeSupplyOrder();
        $fakeSupplyOrder = $this->fakeSupplyOrderData();
        $updatedSupplyOrder = $this->supplyOrderRepo->update($fakeSupplyOrder, $supplyOrder->id);
        $this->assertModelData($fakeSupplyOrder, $updatedSupplyOrder->toArray());
        $dbSupplyOrder = $this->supplyOrderRepo->find($supplyOrder->id);
        $this->assertModelData($fakeSupplyOrder, $dbSupplyOrder->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSupplyOrder()
    {
        $supplyOrder = $this->makeSupplyOrder();
        $resp = $this->supplyOrderRepo->delete($supplyOrder->id);
        $this->assertTrue($resp);
        $this->assertNull(SupplyOrder::find($supplyOrder->id), 'SupplyOrder should not exist in DB');
    }
}
