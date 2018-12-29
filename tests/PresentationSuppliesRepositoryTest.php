<?php

use App\Models\PresentationSupplies;
use App\Repositories\PresentationSuppliesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PresentationSuppliesRepositoryTest extends TestCase
{
    use MakePresentationSuppliesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PresentationSuppliesRepository
     */
    protected $presentationSuppliesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->presentationSuppliesRepo = App::make(PresentationSuppliesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePresentationSupplies()
    {
        $presentationSupplies = $this->fakePresentationSuppliesData();
        $createdPresentationSupplies = $this->presentationSuppliesRepo->create($presentationSupplies);
        $createdPresentationSupplies = $createdPresentationSupplies->toArray();
        $this->assertArrayHasKey('id', $createdPresentationSupplies);
        $this->assertNotNull($createdPresentationSupplies['id'], 'Created PresentationSupplies must have id specified');
        $this->assertNotNull(PresentationSupplies::find($createdPresentationSupplies['id']), 'PresentationSupplies with given id must be in DB');
        $this->assertModelData($presentationSupplies, $createdPresentationSupplies);
    }

    /**
     * @test read
     */
    public function testReadPresentationSupplies()
    {
        $presentationSupplies = $this->makePresentationSupplies();
        $dbPresentationSupplies = $this->presentationSuppliesRepo->find($presentationSupplies->id);
        $dbPresentationSupplies = $dbPresentationSupplies->toArray();
        $this->assertModelData($presentationSupplies->toArray(), $dbPresentationSupplies);
    }

    /**
     * @test update
     */
    public function testUpdatePresentationSupplies()
    {
        $presentationSupplies = $this->makePresentationSupplies();
        $fakePresentationSupplies = $this->fakePresentationSuppliesData();
        $updatedPresentationSupplies = $this->presentationSuppliesRepo->update($fakePresentationSupplies, $presentationSupplies->id);
        $this->assertModelData($fakePresentationSupplies, $updatedPresentationSupplies->toArray());
        $dbPresentationSupplies = $this->presentationSuppliesRepo->find($presentationSupplies->id);
        $this->assertModelData($fakePresentationSupplies, $dbPresentationSupplies->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePresentationSupplies()
    {
        $presentationSupplies = $this->makePresentationSupplies();
        $resp = $this->presentationSuppliesRepo->delete($presentationSupplies->id);
        $this->assertTrue($resp);
        $this->assertNull(PresentationSupplies::find($presentationSupplies->id), 'PresentationSupplies should not exist in DB');
    }
}
