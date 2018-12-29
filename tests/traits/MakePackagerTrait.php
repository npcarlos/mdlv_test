<?php

use Faker\Factory as Faker;
use App\Models\Packager;
use App\Repositories\PackagerRepository;

trait MakePackagerTrait
{
    /**
     * Create fake instance of Packager and save it in database
     *
     * @param array $packagerFields
     * @return Packager
     */
    public function makePackager($packagerFields = [])
    {
        /** @var PackagerRepository $packagerRepo */
        $packagerRepo = App::make(PackagerRepository::class);
        $theme = $this->fakePackagerData($packagerFields);
        return $packagerRepo->create($theme);
    }

    /**
     * Get fake instance of Packager
     *
     * @param array $packagerFields
     * @return Packager
     */
    public function fakePackager($packagerFields = [])
    {
        return new Packager($this->fakePackagerData($packagerFields));
    }

    /**
     * Get fake data of Packager
     *
     * @param array $postFields
     * @return array
     */
    public function fakePackagerData($packagerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'person_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $packagerFields);
    }
}
