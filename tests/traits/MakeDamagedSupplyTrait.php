<?php

use Faker\Factory as Faker;
use App\Models\DamagedSupply;
use App\Repositories\DamagedSupplyRepository;

trait MakeDamagedSupplyTrait
{
    /**
     * Create fake instance of DamagedSupply and save it in database
     *
     * @param array $damagedSupplyFields
     * @return DamagedSupply
     */
    public function makeDamagedSupply($damagedSupplyFields = [])
    {
        /** @var DamagedSupplyRepository $damagedSupplyRepo */
        $damagedSupplyRepo = App::make(DamagedSupplyRepository::class);
        $theme = $this->fakeDamagedSupplyData($damagedSupplyFields);
        return $damagedSupplyRepo->create($theme);
    }

    /**
     * Get fake instance of DamagedSupply
     *
     * @param array $damagedSupplyFields
     * @return DamagedSupply
     */
    public function fakeDamagedSupply($damagedSupplyFields = [])
    {
        return new DamagedSupply($this->fakeDamagedSupplyData($damagedSupplyFields));
    }

    /**
     * Get fake data of DamagedSupply
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDamagedSupplyData($damagedSupplyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'supply_id' => $fake->randomDigitNotNull,
            'prelot_order_id' => $fake->randomDigitNotNull,
            'quantity' => $fake->randomDigitNotNull,
            'damage_description' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $damagedSupplyFields);
    }
}
