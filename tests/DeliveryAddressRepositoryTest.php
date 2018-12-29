<?php

use App\Models\DeliveryAddress;
use App\Repositories\DeliveryAddressRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeliveryAddressRepositoryTest extends TestCase
{
    use MakeDeliveryAddressTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DeliveryAddressRepository
     */
    protected $deliveryAddressRepo;

    public function setUp()
    {
        parent::setUp();
        $this->deliveryAddressRepo = App::make(DeliveryAddressRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDeliveryAddress()
    {
        $deliveryAddress = $this->fakeDeliveryAddressData();
        $createdDeliveryAddress = $this->deliveryAddressRepo->create($deliveryAddress);
        $createdDeliveryAddress = $createdDeliveryAddress->toArray();
        $this->assertArrayHasKey('id', $createdDeliveryAddress);
        $this->assertNotNull($createdDeliveryAddress['id'], 'Created DeliveryAddress must have id specified');
        $this->assertNotNull(DeliveryAddress::find($createdDeliveryAddress['id']), 'DeliveryAddress with given id must be in DB');
        $this->assertModelData($deliveryAddress, $createdDeliveryAddress);
    }

    /**
     * @test read
     */
    public function testReadDeliveryAddress()
    {
        $deliveryAddress = $this->makeDeliveryAddress();
        $dbDeliveryAddress = $this->deliveryAddressRepo->find($deliveryAddress->id);
        $dbDeliveryAddress = $dbDeliveryAddress->toArray();
        $this->assertModelData($deliveryAddress->toArray(), $dbDeliveryAddress);
    }

    /**
     * @test update
     */
    public function testUpdateDeliveryAddress()
    {
        $deliveryAddress = $this->makeDeliveryAddress();
        $fakeDeliveryAddress = $this->fakeDeliveryAddressData();
        $updatedDeliveryAddress = $this->deliveryAddressRepo->update($fakeDeliveryAddress, $deliveryAddress->id);
        $this->assertModelData($fakeDeliveryAddress, $updatedDeliveryAddress->toArray());
        $dbDeliveryAddress = $this->deliveryAddressRepo->find($deliveryAddress->id);
        $this->assertModelData($fakeDeliveryAddress, $dbDeliveryAddress->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDeliveryAddress()
    {
        $deliveryAddress = $this->makeDeliveryAddress();
        $resp = $this->deliveryAddressRepo->delete($deliveryAddress->id);
        $this->assertTrue($resp);
        $this->assertNull(DeliveryAddress::find($deliveryAddress->id), 'DeliveryAddress should not exist in DB');
    }
}
