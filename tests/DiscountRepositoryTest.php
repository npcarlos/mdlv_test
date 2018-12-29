<?php

use App\Models\Discount;
use App\Repositories\DiscountRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DiscountRepositoryTest extends TestCase
{
    use MakeDiscountTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DiscountRepository
     */
    protected $discountRepo;

    public function setUp()
    {
        parent::setUp();
        $this->discountRepo = App::make(DiscountRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDiscount()
    {
        $discount = $this->fakeDiscountData();
        $createdDiscount = $this->discountRepo->create($discount);
        $createdDiscount = $createdDiscount->toArray();
        $this->assertArrayHasKey('id', $createdDiscount);
        $this->assertNotNull($createdDiscount['id'], 'Created Discount must have id specified');
        $this->assertNotNull(Discount::find($createdDiscount['id']), 'Discount with given id must be in DB');
        $this->assertModelData($discount, $createdDiscount);
    }

    /**
     * @test read
     */
    public function testReadDiscount()
    {
        $discount = $this->makeDiscount();
        $dbDiscount = $this->discountRepo->find($discount->id);
        $dbDiscount = $dbDiscount->toArray();
        $this->assertModelData($discount->toArray(), $dbDiscount);
    }

    /**
     * @test update
     */
    public function testUpdateDiscount()
    {
        $discount = $this->makeDiscount();
        $fakeDiscount = $this->fakeDiscountData();
        $updatedDiscount = $this->discountRepo->update($fakeDiscount, $discount->id);
        $this->assertModelData($fakeDiscount, $updatedDiscount->toArray());
        $dbDiscount = $this->discountRepo->find($discount->id);
        $this->assertModelData($fakeDiscount, $dbDiscount->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDiscount()
    {
        $discount = $this->makeDiscount();
        $resp = $this->discountRepo->delete($discount->id);
        $this->assertTrue($resp);
        $this->assertNull(Discount::find($discount->id), 'Discount should not exist in DB');
    }
}
