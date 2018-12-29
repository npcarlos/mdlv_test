<?php

use Faker\Factory as Faker;
use App\Models\OrderItem;
use App\Repositories\OrderItemRepository;

trait MakeOrderItemTrait
{
    /**
     * Create fake instance of OrderItem and save it in database
     *
     * @param array $orderItemFields
     * @return OrderItem
     */
    public function makeOrderItem($orderItemFields = [])
    {
        /** @var OrderItemRepository $orderItemRepo */
        $orderItemRepo = App::make(OrderItemRepository::class);
        $theme = $this->fakeOrderItemData($orderItemFields);
        return $orderItemRepo->create($theme);
    }

    /**
     * Get fake instance of OrderItem
     *
     * @param array $orderItemFields
     * @return OrderItem
     */
    public function fakeOrderItem($orderItemFields = [])
    {
        return new OrderItem($this->fakeOrderItemData($orderItemFields));
    }

    /**
     * Get fake data of OrderItem
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOrderItemData($orderItemFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'order_id' => $fake->randomDigitNotNull,
            'presentation_id' => $fake->randomDigitNotNull,
            'quantity' => $fake->randomDigitNotNull,
            'discount_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $orderItemFields);
    }
}
