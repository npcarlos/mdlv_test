<?php

use Faker\Factory as Faker;
use App\Models\SupplyCategory;
use App\Repositories\SupplyCategoryRepository;

trait MakeSupplyCategoryTrait
{
    /**
     * Create fake instance of SupplyCategory and save it in database
     *
     * @param array $supplyCategoryFields
     * @return SupplyCategory
     */
    public function makeSupplyCategory($supplyCategoryFields = [])
    {
        /** @var SupplyCategoryRepository $supplyCategoryRepo */
        $supplyCategoryRepo = App::make(SupplyCategoryRepository::class);
        $theme = $this->fakeSupplyCategoryData($supplyCategoryFields);
        return $supplyCategoryRepo->create($theme);
    }

    /**
     * Get fake instance of SupplyCategory
     *
     * @param array $supplyCategoryFields
     * @return SupplyCategory
     */
    public function fakeSupplyCategory($supplyCategoryFields = [])
    {
        return new SupplyCategory($this->fakeSupplyCategoryData($supplyCategoryFields));
    }

    /**
     * Get fake data of SupplyCategory
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSupplyCategoryData($supplyCategoryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'uuid' => $fake->word,
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $supplyCategoryFields);
    }
}
