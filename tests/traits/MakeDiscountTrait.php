<?php

use Faker\Factory as Faker;
use App\Models\Discount;
use App\Repositories\DiscountRepository;

trait MakeDiscountTrait
{
    /**
     * Create fake instance of Discount and save it in database
     *
     * @param array $discountFields
     * @return Discount
     */
    public function makeDiscount($discountFields = [])
    {
        /** @var DiscountRepository $discountRepo */
        $discountRepo = App::make(DiscountRepository::class);
        $theme = $this->fakeDiscountData($discountFields);
        return $discountRepo->create($theme);
    }

    /**
     * Get fake instance of Discount
     *
     * @param array $discountFields
     * @return Discount
     */
    public function fakeDiscount($discountFields = [])
    {
        return new Discount($this->fakeDiscountData($discountFields));
    }

    /**
     * Get fake data of Discount
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDiscountData($discountFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'discount_percentage' => $fake->randomDigitNotNull,
            'comments' => $fake->word,
            'initial_date' => $fake->date('Y-m-d H:i:s'),
            'final_date' => $fake->date('Y-m-d H:i:s'),
            'image' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $discountFields);
    }
}
