<?php

use Faker\Factory as Faker;
use App\Models\PrelotOrder;
use App\Repositories\PrelotOrderRepository;

trait MakePrelotOrderTrait
{
    /**
     * Create fake instance of PrelotOrder and save it in database
     *
     * @param array $prelotOrderFields
     * @return PrelotOrder
     */
    public function makePrelotOrder($prelotOrderFields = [])
    {
        /** @var PrelotOrderRepository $prelotOrderRepo */
        $prelotOrderRepo = App::make(PrelotOrderRepository::class);
        $theme = $this->fakePrelotOrderData($prelotOrderFields);
        return $prelotOrderRepo->create($theme);
    }

    /**
     * Get fake instance of PrelotOrder
     *
     * @param array $prelotOrderFields
     * @return PrelotOrder
     */
    public function fakePrelotOrder($prelotOrderFields = [])
    {
        return new PrelotOrder($this->fakePrelotOrderData($prelotOrderFields));
    }

    /**
     * Get fake data of PrelotOrder
     *
     * @param array $postFields
     * @return array
     */
    public function fakePrelotOrderData($prelotOrderFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'presentation_id' => $fake->randomDigitNotNull,
            'packager_id' => $fake->randomDigitNotNull,
            'prelot_status_id' => $fake->randomDigitNotNull,
            'requested_quantity' => $fake->randomDigitNotNull,
            'real_quantity' => $fake->randomDigitNotNull,
            'planned_packaging_date' => $fake->date('Y-m-d H:i:s'),
            'packaged_date' => $fake->date('Y-m-d H:i:s'),
            'comments' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $prelotOrderFields);
    }
}
