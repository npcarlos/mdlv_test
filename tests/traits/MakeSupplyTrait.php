<?php

use Faker\Factory as Faker;
use App\Models\Supply;
use App\Repositories\SupplyRepository;

trait MakeSupplyTrait
{
    /**
     * Create fake instance of Supply and save it in database
     *
     * @param array $supplyFields
     * @return Supply
     */
    public function makeSupply($supplyFields = [])
    {
        /** @var SupplyRepository $supplyRepo */
        $supplyRepo = App::make(SupplyRepository::class);
        $theme = $this->fakeSupplyData($supplyFields);
        return $supplyRepo->create($theme);
    }

    /**
     * Get fake instance of Supply
     *
     * @param array $supplyFields
     * @return Supply
     */
    public function fakeSupply($supplyFields = [])
    {
        return new Supply($this->fakeSupplyData($supplyFields));
    }

    /**
     * Get fake data of Supply
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSupplyData($supplyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'supply_category_id' => $fake->randomDigitNotNull,
            'name' => $fake->word,
            'slug' => $fake->word,
            'provider_id' => $fake->randomDigitNotNull,
            'measurement_quantity' => $fake->word,
            'measurement_unit_id' => $fake->randomDigitNotNull,
            'minimum_stock_quantity' => $fake->randomDigitNotNull,
            'stock_quantity' => $fake->randomDigitNotNull,
            'minimum_quantity' => $fake->randomDigitNotNull,
            'unitary_value' => $fake->word,
            'iva' => $fake->word,
            'image' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $supplyFields);
    }
}
