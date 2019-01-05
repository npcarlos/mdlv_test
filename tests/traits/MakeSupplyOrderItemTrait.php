<?php

use Faker\Factory as Faker;
use App\Models\SupplyOrderItem;
use App\Repositories\SupplyOrderItemRepository;

trait MakeSupplyOrderItemTrait
{
    /**
     * Create fake instance of SupplyOrderItem and save it in database
     *
     * @param array $supplyOrderItemFields
     * @return SupplyOrderItem
     */
    public function makeSupplyOrderItem($supplyOrderItemFields = [])
    {
        /** @var SupplyOrderItemRepository $supplyOrderItemRepo */
        $supplyOrderItemRepo = App::make(SupplyOrderItemRepository::class);
        $theme = $this->fakeSupplyOrderItemData($supplyOrderItemFields);
        return $supplyOrderItemRepo->create($theme);
    }

    /**
     * Get fake instance of SupplyOrderItem
     *
     * @param array $supplyOrderItemFields
     * @return SupplyOrderItem
     */
    public function fakeSupplyOrderItem($supplyOrderItemFields = [])
    {
        return new SupplyOrderItem($this->fakeSupplyOrderItemData($supplyOrderItemFields));
    }

    /**
     * Get fake data of SupplyOrderItem
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSupplyOrderItemData($supplyOrderItemFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'uuid' => $fake->word,
            'supply_order_id' => $fake->randomDigitNotNull,
            'supply_id' => $fake->randomDigitNotNull,
            'quantity' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $supplyOrderItemFields);
    }
}
