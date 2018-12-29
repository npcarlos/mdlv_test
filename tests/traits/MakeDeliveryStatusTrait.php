<?php

use Faker\Factory as Faker;
use App\Models\DeliveryStatus;
use App\Repositories\DeliveryStatusRepository;

trait MakeDeliveryStatusTrait
{
    /**
     * Create fake instance of DeliveryStatus and save it in database
     *
     * @param array $deliveryStatusFields
     * @return DeliveryStatus
     */
    public function makeDeliveryStatus($deliveryStatusFields = [])
    {
        /** @var DeliveryStatusRepository $deliveryStatusRepo */
        $deliveryStatusRepo = App::make(DeliveryStatusRepository::class);
        $theme = $this->fakeDeliveryStatusData($deliveryStatusFields);
        return $deliveryStatusRepo->create($theme);
    }

    /**
     * Get fake instance of DeliveryStatus
     *
     * @param array $deliveryStatusFields
     * @return DeliveryStatus
     */
    public function fakeDeliveryStatus($deliveryStatusFields = [])
    {
        return new DeliveryStatus($this->fakeDeliveryStatusData($deliveryStatusFields));
    }

    /**
     * Get fake data of DeliveryStatus
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDeliveryStatusData($deliveryStatusFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $deliveryStatusFields);
    }
}
