<?php

use Faker\Factory as Faker;
use App\Models\PrelotStatus;
use App\Repositories\PrelotStatusRepository;

trait MakePrelotStatusTrait
{
    /**
     * Create fake instance of PrelotStatus and save it in database
     *
     * @param array $prelotStatusFields
     * @return PrelotStatus
     */
    public function makePrelotStatus($prelotStatusFields = [])
    {
        /** @var PrelotStatusRepository $prelotStatusRepo */
        $prelotStatusRepo = App::make(PrelotStatusRepository::class);
        $theme = $this->fakePrelotStatusData($prelotStatusFields);
        return $prelotStatusRepo->create($theme);
    }

    /**
     * Get fake instance of PrelotStatus
     *
     * @param array $prelotStatusFields
     * @return PrelotStatus
     */
    public function fakePrelotStatus($prelotStatusFields = [])
    {
        return new PrelotStatus($this->fakePrelotStatusData($prelotStatusFields));
    }

    /**
     * Get fake data of PrelotStatus
     *
     * @param array $postFields
     * @return array
     */
    public function fakePrelotStatusData($prelotStatusFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $prelotStatusFields);
    }
}
