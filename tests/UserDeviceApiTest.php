<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserDeviceApiTest extends TestCase
{
    use MakeUserDeviceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUserDevice()
    {
        $userDevice = $this->fakeUserDeviceData();
        $this->json('POST', '/api/v1/userDevices', $userDevice);

        $this->assertApiResponse($userDevice);
    }

    /**
     * @test
     */
    public function testReadUserDevice()
    {
        $userDevice = $this->makeUserDevice();
        $this->json('GET', '/api/v1/userDevices/'.$userDevice->id);

        $this->assertApiResponse($userDevice->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUserDevice()
    {
        $userDevice = $this->makeUserDevice();
        $editedUserDevice = $this->fakeUserDeviceData();

        $this->json('PUT', '/api/v1/userDevices/'.$userDevice->id, $editedUserDevice);

        $this->assertApiResponse($editedUserDevice);
    }

    /**
     * @test
     */
    public function testDeleteUserDevice()
    {
        $userDevice = $this->makeUserDevice();
        $this->json('DELETE', '/api/v1/userDevices/'.$userDevice->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/userDevices/'.$userDevice->id);

        $this->assertResponseStatus(404);
    }
}
