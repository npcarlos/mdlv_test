<?php

use App\Models\Packager;
use App\Repositories\PackagerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PackagerRepositoryTest extends TestCase
{
    use MakePackagerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PackagerRepository
     */
    protected $packagerRepo;

    public function setUp()
    {
        parent::setUp();
        $this->packagerRepo = App::make(PackagerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePackager()
    {
        $packager = $this->fakePackagerData();
        $createdPackager = $this->packagerRepo->create($packager);
        $createdPackager = $createdPackager->toArray();
        $this->assertArrayHasKey('id', $createdPackager);
        $this->assertNotNull($createdPackager['id'], 'Created Packager must have id specified');
        $this->assertNotNull(Packager::find($createdPackager['id']), 'Packager with given id must be in DB');
        $this->assertModelData($packager, $createdPackager);
    }

    /**
     * @test read
     */
    public function testReadPackager()
    {
        $packager = $this->makePackager();
        $dbPackager = $this->packagerRepo->find($packager->id);
        $dbPackager = $dbPackager->toArray();
        $this->assertModelData($packager->toArray(), $dbPackager);
    }

    /**
     * @test update
     */
    public function testUpdatePackager()
    {
        $packager = $this->makePackager();
        $fakePackager = $this->fakePackagerData();
        $updatedPackager = $this->packagerRepo->update($fakePackager, $packager->id);
        $this->assertModelData($fakePackager, $updatedPackager->toArray());
        $dbPackager = $this->packagerRepo->find($packager->id);
        $this->assertModelData($fakePackager, $dbPackager->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePackager()
    {
        $packager = $this->makePackager();
        $resp = $this->packagerRepo->delete($packager->id);
        $this->assertTrue($resp);
        $this->assertNull(Packager::find($packager->id), 'Packager should not exist in DB');
    }
}
