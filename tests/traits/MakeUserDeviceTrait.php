<?php

use Faker\Factory as Faker;
use App\Models\UserDevice;
use App\Repositories\UserDeviceRepository;

trait MakeUserDeviceTrait
{
    /**
     * Create fake instance of UserDevice and save it in database
     *
     * @param array $userDeviceFields
     * @return UserDevice
     */
    public function makeUserDevice($userDeviceFields = [])
    {
        /** @var UserDeviceRepository $userDeviceRepo */
        $userDeviceRepo = App::make(UserDeviceRepository::class);
        $theme = $this->fakeUserDeviceData($userDeviceFields);
        return $userDeviceRepo->create($theme);
    }

    /**
     * Get fake instance of UserDevice
     *
     * @param array $userDeviceFields
     * @return UserDevice
     */
    public function fakeUserDevice($userDeviceFields = [])
    {
        return new UserDevice($this->fakeUserDeviceData($userDeviceFields));
    }

    /**
     * Get fake data of UserDevice
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUserDeviceData($userDeviceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'uuid' => $fake->word,
            'user' => $fake->word,
            'token' => $fake->word,
            'device' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $userDeviceFields);
    }
}
