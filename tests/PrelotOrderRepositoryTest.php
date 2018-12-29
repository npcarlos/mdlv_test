<?php

use App\Models\PrelotOrder;
use App\Repositories\PrelotOrderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PrelotOrderRepositoryTest extends TestCase
{
    use MakePrelotOrderTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PrelotOrderRepository
     */
    protected $prelotOrderRepo;

    public function setUp()
    {
        parent::setUp();
        $this->prelotOrderRepo = App::make(PrelotOrderRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePrelotOrder()
    {
        $prelotOrder = $this->fakePrelotOrderData();
        $createdPrelotOrder = $this->prelotOrderRepo->create($prelotOrder);
        $createdPrelotOrder = $createdPrelotOrder->toArray();
        $this->assertArrayHasKey('id', $createdPrelotOrder);
        $this->assertNotNull($createdPrelotOrder['id'], 'Created PrelotOrder must have id specified');
        $this->assertNotNull(PrelotOrder::find($createdPrelotOrder['id']), 'PrelotOrder with given id must be in DB');
        $this->assertModelData($prelotOrder, $createdPrelotOrder);
    }

    /**
     * @test read
     */
    public function testReadPrelotOrder()
    {
        $prelotOrder = $this->makePrelotOrder();
        $dbPrelotOrder = $this->prelotOrderRepo->find($prelotOrder->id);
        $dbPrelotOrder = $dbPrelotOrder->toArray();
        $this->assertModelData($prelotOrder->toArray(), $dbPrelotOrder);
    }

    /**
     * @test update
     */
    public function testUpdatePrelotOrder()
    {
        $prelotOrder = $this->makePrelotOrder();
        $fakePrelotOrder = $this->fakePrelotOrderData();
        $updatedPrelotOrder = $this->prelotOrderRepo->update($fakePrelotOrder, $prelotOrder->id);
        $this->assertModelData($fakePrelotOrder, $updatedPrelotOrder->toArray());
        $dbPrelotOrder = $this->prelotOrderRepo->find($prelotOrder->id);
        $this->assertModelData($fakePrelotOrder, $dbPrelotOrder->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePrelotOrder()
    {
        $prelotOrder = $this->makePrelotOrder();
        $resp = $this->prelotOrderRepo->delete($prelotOrder->id);
        $this->assertTrue($resp);
        $this->assertNull(PrelotOrder::find($prelotOrder->id), 'PrelotOrder should not exist in DB');
    }
}
