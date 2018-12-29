<?php

use App\Models\DeliveryStatus;
use App\Repositories\DeliveryStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeliveryStatusRepositoryTest extends TestCase
{
    use MakeDeliveryStatusTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DeliveryStatusRepository
     */
    protected $deliveryStatusRepo;

    public function setUp()
    {
        parent::setUp();
        $this->deliveryStatusRepo = App::make(DeliveryStatusRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDeliveryStatus()
    {
        $deliveryStatus = $this->fakeDeliveryStatusData();
        $createdDeliveryStatus = $this->deliveryStatusRepo->create($deliveryStatus);
        $createdDeliveryStatus = $createdDeliveryStatus->toArray();
        $this->assertArrayHasKey('id', $createdDeliveryStatus);
        $this->assertNotNull($createdDeliveryStatus['id'], 'Created DeliveryStatus must have id specified');
        $this->assertNotNull(DeliveryStatus::find($createdDeliveryStatus['id']), 'DeliveryStatus with given id must be in DB');
        $this->assertModelData($deliveryStatus, $createdDeliveryStatus);
    }

    /**
     * @test read
     */
    public function testReadDeliveryStatus()
    {
        $deliveryStatus = $this->makeDeliveryStatus();
        $dbDeliveryStatus = $this->deliveryStatusRepo->find($deliveryStatus->id);
        $dbDeliveryStatus = $dbDeliveryStatus->toArray();
        $this->assertModelData($deliveryStatus->toArray(), $dbDeliveryStatus);
    }

    /**
     * @test update
     */
    public function testUpdateDeliveryStatus()
    {
        $deliveryStatus = $this->makeDeliveryStatus();
        $fakeDeliveryStatus = $this->fakeDeliveryStatusData();
        $updatedDeliveryStatus = $this->deliveryStatusRepo->update($fakeDeliveryStatus, $deliveryStatus->id);
        $this->assertModelData($fakeDeliveryStatus, $updatedDeliveryStatus->toArray());
        $dbDeliveryStatus = $this->deliveryStatusRepo->find($deliveryStatus->id);
        $this->assertModelData($fakeDeliveryStatus, $dbDeliveryStatus->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDeliveryStatus()
    {
        $deliveryStatus = $this->makeDeliveryStatus();
        $resp = $this->deliveryStatusRepo->delete($deliveryStatus->id);
        $this->assertTrue($resp);
        $this->assertNull(DeliveryStatus::find($deliveryStatus->id), 'DeliveryStatus should not exist in DB');
    }
}
