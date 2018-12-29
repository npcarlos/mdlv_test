<?php

use Faker\Factory as Faker;
use App\Models\Provider;
use App\Repositories\ProviderRepository;

trait MakeProviderTrait
{
    /**
     * Create fake instance of Provider and save it in database
     *
     * @param array $providerFields
     * @return Provider
     */
    public function makeProvider($providerFields = [])
    {
        /** @var ProviderRepository $providerRepo */
        $providerRepo = App::make(ProviderRepository::class);
        $theme = $this->fakeProviderData($providerFields);
        return $providerRepo->create($theme);
    }

    /**
     * Get fake instance of Provider
     *
     * @param array $providerFields
     * @return Provider
     */
    public function fakeProvider($providerFields = [])
    {
        return new Provider($this->fakeProviderData($providerFields));
    }

    /**
     * Get fake data of Provider
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProviderData($providerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'document_type_id' => $fake->randomDigitNotNull,
            'document_number' => $fake->word,
            'address' => $fake->word,
            'latitude' => $fake->word,
            'longitude' => $fake->word,
            'phone' => $fake->word,
            'cellphone' => $fake->word,
            'web' => $fake->word,
            'facebook_id' => $fake->word,
            'instagram_id' => $fake->word,
            'slug' => $fake->word,
            'image' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $providerFields);
    }
}
