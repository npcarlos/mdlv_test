<?php

use Faker\Factory as Faker;
use App\Models\PresentationSupplies;
use App\Repositories\PresentationSuppliesRepository;

trait MakePresentationSuppliesTrait
{
    /**
     * Create fake instance of PresentationSupplies and save it in database
     *
     * @param array $presentationSuppliesFields
     * @return PresentationSupplies
     */
    public function makePresentationSupplies($presentationSuppliesFields = [])
    {
        /** @var PresentationSuppliesRepository $presentationSuppliesRepo */
        $presentationSuppliesRepo = App::make(PresentationSuppliesRepository::class);
        $theme = $this->fakePresentationSuppliesData($presentationSuppliesFields);
        return $presentationSuppliesRepo->create($theme);
    }

    /**
     * Get fake instance of PresentationSupplies
     *
     * @param array $presentationSuppliesFields
     * @return PresentationSupplies
     */
    public function fakePresentationSupplies($presentationSuppliesFields = [])
    {
        return new PresentationSupplies($this->fakePresentationSuppliesData($presentationSuppliesFields));
    }

    /**
     * Get fake data of PresentationSupplies
     *
     * @param array $postFields
     * @return array
     */
    public function fakePresentationSuppliesData($presentationSuppliesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'uuid' => $fake->word,
            'presentation_id' => $fake->randomDigitNotNull,
            'supply_id' => $fake->randomDigitNotNull,
            'quantity' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $presentationSuppliesFields);
    }
}
