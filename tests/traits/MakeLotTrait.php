<?php

use Faker\Factory as Faker;
use App\Models\Lot;
use App\Repositories\LotRepository;

trait MakeLotTrait
{
    /**
     * Create fake instance of Lot and save it in database
     *
     * @param array $lotFields
     * @return Lot
     */
    public function makeLot($lotFields = [])
    {
        /** @var LotRepository $lotRepo */
        $lotRepo = App::make(LotRepository::class);
        $theme = $this->fakeLotData($lotFields);
        return $lotRepo->create($theme);
    }

    /**
     * Get fake instance of Lot
     *
     * @param array $lotFields
     * @return Lot
     */
    public function fakeLot($lotFields = [])
    {
        return new Lot($this->fakeLotData($lotFields));
    }

    /**
     * Get fake data of Lot
     *
     * @param array $postFields
     * @return array
     */
    public function fakeLotData($lotFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'presentation_id' => $fake->randomDigitNotNull,
            'packager_id' => $fake->randomDigitNotNull,
            'quantity' => $fake->randomDigitNotNull,
            'production_date' => $fake->word,
            'slug' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $lotFields);
    }
}
