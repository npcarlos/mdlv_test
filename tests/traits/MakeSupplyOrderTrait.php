<?php

use Faker\Factory as Faker;
use App\Models\SupplyOrder;
use App\Repositories\SupplyOrderRepository;

trait MakeSupplyOrderTrait
{
    /**
     * Create fake instance of SupplyOrder and save it in database
     *
     * @param array $supplyOrderFields
     * @return SupplyOrder
     */
    public function makeSupplyOrder($supplyOrderFields = [])
    {
        /** @var SupplyOrderRepository $supplyOrderRepo */
        $supplyOrderRepo = App::make(SupplyOrderRepository::class);
        $theme = $this->fakeSupplyOrderData($supplyOrderFields);
        return $supplyOrderRepo->create($theme);
    }

    /**
     * Get fake instance of SupplyOrder
     *
     * @param array $supplyOrderFields
     * @return SupplyOrder
     */
    public function fakeSupplyOrder($supplyOrderFields = [])
    {
        return new SupplyOrder($this->fakeSupplyOrderData($supplyOrderFields));
    }

    /**
     * Get fake data of SupplyOrder
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSupplyOrderData($supplyOrderFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'uuid' => $fake->word,
            'provider_id' => $fake->randomDigitNotNull,
            'administrator_id' => $fake->randomDigitNotNull,
            'comments' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $supplyOrderFields);
    }
}
