<?php

use Faker\Factory as Faker;
use App\Models\DeliveryAddress;
use App\Repositories\DeliveryAddressRepository;

trait MakeDeliveryAddressTrait
{
    /**
     * Create fake instance of DeliveryAddress and save it in database
     *
     * @param array $deliveryAddressFields
     * @return DeliveryAddress
     */
    public function makeDeliveryAddress($deliveryAddressFields = [])
    {
        /** @var DeliveryAddressRepository $deliveryAddressRepo */
        $deliveryAddressRepo = App::make(DeliveryAddressRepository::class);
        $theme = $this->fakeDeliveryAddressData($deliveryAddressFields);
        return $deliveryAddressRepo->create($theme);
    }

    /**
     * Get fake instance of DeliveryAddress
     *
     * @param array $deliveryAddressFields
     * @return DeliveryAddress
     */
    public function fakeDeliveryAddress($deliveryAddressFields = [])
    {
        return new DeliveryAddress($this->fakeDeliveryAddressData($deliveryAddressFields));
    }

    /**
     * Get fake data of DeliveryAddress
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDeliveryAddressData($deliveryAddressFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'customer_id' => $fake->randomDigitNotNull,
            'address' => $fake->word,
            'latitude' => $fake->word,
            'longitude' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $deliveryAddressFields);
    }
}
