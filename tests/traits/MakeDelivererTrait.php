<?php

use Faker\Factory as Faker;
use App\Models\Deliverer;
use App\Repositories\DelivererRepository;

trait MakeDelivererTrait
{
    /**
     * Create fake instance of Deliverer and save it in database
     *
     * @param array $delivererFields
     * @return Deliverer
     */
    public function makeDeliverer($delivererFields = [])
    {
        /** @var DelivererRepository $delivererRepo */
        $delivererRepo = App::make(DelivererRepository::class);
        $theme = $this->fakeDelivererData($delivererFields);
        return $delivererRepo->create($theme);
    }

    /**
     * Get fake instance of Deliverer
     *
     * @param array $delivererFields
     * @return Deliverer
     */
    public function fakeDeliverer($delivererFields = [])
    {
        return new Deliverer($this->fakeDelivererData($delivererFields));
    }

    /**
     * Get fake data of Deliverer
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDelivererData($delivererFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'uuid' => $fake->word,
            'person_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $delivererFields);
    }
}
