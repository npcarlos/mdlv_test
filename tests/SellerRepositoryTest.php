<?php

use App\Models\Seller;
use App\Repositories\SellerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SellerRepositoryTest extends TestCase
{
    use MakeSellerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SellerRepository
     */
    protected $sellerRepo;

    public function setUp()
    {
        parent::setUp();
        $this->sellerRepo = App::make(SellerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSeller()
    {
        $seller = $this->fakeSellerData();
        $createdSeller = $this->sellerRepo->create($seller);
        $createdSeller = $createdSeller->toArray();
        $this->assertArrayHasKey('id', $createdSeller);
        $this->assertNotNull($createdSeller['id'], 'Created Seller must have id specified');
        $this->assertNotNull(Seller::find($createdSeller['id']), 'Seller with given id must be in DB');
        $this->assertModelData($seller, $createdSeller);
    }

    /**
     * @test read
     */
    public function testReadSeller()
    {
        $seller = $this->makeSeller();
        $dbSeller = $this->sellerRepo->find($seller->id);
        $dbSeller = $dbSeller->toArray();
        $this->assertModelData($seller->toArray(), $dbSeller);
    }

    /**
     * @test update
     */
    public function testUpdateSeller()
    {
        $seller = $this->makeSeller();
        $fakeSeller = $this->fakeSellerData();
        $updatedSeller = $this->sellerRepo->update($fakeSeller, $seller->id);
        $this->assertModelData($fakeSeller, $updatedSeller->toArray());
        $dbSeller = $this->sellerRepo->find($seller->id);
        $this->assertModelData($fakeSeller, $dbSeller->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSeller()
    {
        $seller = $this->makeSeller();
        $resp = $this->sellerRepo->delete($seller->id);
        $this->assertTrue($resp);
        $this->assertNull(Seller::find($seller->id), 'Seller should not exist in DB');
    }
}
