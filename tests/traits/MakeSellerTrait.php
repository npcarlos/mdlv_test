<?php

use Faker\Factory as Faker;
use App\Models\Seller;
use App\Repositories\SellerRepository;

trait MakeSellerTrait
{
    /**
     * Create fake instance of Seller and save it in database
     *
     * @param array $sellerFields
     * @return Seller
     */
    public function makeSeller($sellerFields = [])
    {
        /** @var SellerRepository $sellerRepo */
        $sellerRepo = App::make(SellerRepository::class);
        $theme = $this->fakeSellerData($sellerFields);
        return $sellerRepo->create($theme);
    }

    /**
     * Get fake instance of Seller
     *
     * @param array $sellerFields
     * @return Seller
     */
    public function fakeSeller($sellerFields = [])
    {
        return new Seller($this->fakeSellerData($sellerFields));
    }

    /**
     * Get fake data of Seller
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSellerData($sellerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'uuid' => $fake->word,
            'person_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $sellerFields);
    }
}
