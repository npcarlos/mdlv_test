<?php

use App\Models\Deliverer;
use App\Repositories\DelivererRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DelivererRepositoryTest extends TestCase
{
    use MakeDelivererTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DelivererRepository
     */
    protected $delivererRepo;

    public function setUp()
    {
        parent::setUp();
        $this->delivererRepo = App::make(DelivererRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDeliverer()
    {
        $deliverer = $this->fakeDelivererData();
        $createdDeliverer = $this->delivererRepo->create($deliverer);
        $createdDeliverer = $createdDeliverer->toArray();
        $this->assertArrayHasKey('id', $createdDeliverer);
        $this->assertNotNull($createdDeliverer['id'], 'Created Deliverer must have id specified');
        $this->assertNotNull(Deliverer::find($createdDeliverer['id']), 'Deliverer with given id must be in DB');
        $this->assertModelData($deliverer, $createdDeliverer);
    }

    /**
     * @test read
     */
    public function testReadDeliverer()
    {
        $deliverer = $this->makeDeliverer();
        $dbDeliverer = $this->delivererRepo->find($deliverer->id);
        $dbDeliverer = $dbDeliverer->toArray();
        $this->assertModelData($deliverer->toArray(), $dbDeliverer);
    }

    /**
     * @test update
     */
    public function testUpdateDeliverer()
    {
        $deliverer = $this->makeDeliverer();
        $fakeDeliverer = $this->fakeDelivererData();
        $updatedDeliverer = $this->delivererRepo->update($fakeDeliverer, $deliverer->id);
        $this->assertModelData($fakeDeliverer, $updatedDeliverer->toArray());
        $dbDeliverer = $this->delivererRepo->find($deliverer->id);
        $this->assertModelData($fakeDeliverer, $dbDeliverer->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDeliverer()
    {
        $deliverer = $this->makeDeliverer();
        $resp = $this->delivererRepo->delete($deliverer->id);
        $this->assertTrue($resp);
        $this->assertNull(Deliverer::find($deliverer->id), 'Deliverer should not exist in DB');
    }
}
