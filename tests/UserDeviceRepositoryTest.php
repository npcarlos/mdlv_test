<?php

use App\Models\UserDevice;
use App\Repositories\UserDeviceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserDeviceRepositoryTest extends TestCase
{
    use MakeUserDeviceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserDeviceRepository
     */
    protected $userDeviceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userDeviceRepo = App::make(UserDeviceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUserDevice()
    {
        $userDevice = $this->fakeUserDeviceData();
        $createdUserDevice = $this->userDeviceRepo->create($userDevice);
        $createdUserDevice = $createdUserDevice->toArray();
        $this->assertArrayHasKey('id', $createdUserDevice);
        $this->assertNotNull($createdUserDevice['id'], 'Created UserDevice must have id specified');
        $this->assertNotNull(UserDevice::find($createdUserDevice['id']), 'UserDevice with given id must be in DB');
        $this->assertModelData($userDevice, $createdUserDevice);
    }

    /**
     * @test read
     */
    public function testReadUserDevice()
    {
        $userDevice = $this->makeUserDevice();
        $dbUserDevice = $this->userDeviceRepo->find($userDevice->id);
        $dbUserDevice = $dbUserDevice->toArray();
        $this->assertModelData($userDevice->toArray(), $dbUserDevice);
    }

    /**
     * @test update
     */
    public function testUpdateUserDevice()
    {
        $userDevice = $this->makeUserDevice();
        $fakeUserDevice = $this->fakeUserDeviceData();
        $updatedUserDevice = $this->userDeviceRepo->update($fakeUserDevice, $userDevice->id);
        $this->assertModelData($fakeUserDevice, $updatedUserDevice->toArray());
        $dbUserDevice = $this->userDeviceRepo->find($userDevice->id);
        $this->assertModelData($fakeUserDevice, $dbUserDevice->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUserDevice()
    {
        $userDevice = $this->makeUserDevice();
        $resp = $this->userDeviceRepo->delete($userDevice->id);
        $this->assertTrue($resp);
        $this->assertNull(UserDevice::find($userDevice->id), 'UserDevice should not exist in DB');
    }
}
