<?php

use Faker\Factory as Faker;
use App\Models\MeasurementUnit;
use App\Repositories\MeasurementUnitRepository;

trait MakeMeasurementUnitTrait
{
    /**
     * Create fake instance of MeasurementUnit and save it in database
     *
     * @param array $measurementUnitFields
     * @return MeasurementUnit
     */
    public function makeMeasurementUnit($measurementUnitFields = [])
    {
        /** @var MeasurementUnitRepository $measurementUnitRepo */
        $measurementUnitRepo = App::make(MeasurementUnitRepository::class);
        $theme = $this->fakeMeasurementUnitData($measurementUnitFields);
        return $measurementUnitRepo->create($theme);
    }

    /**
     * Get fake instance of MeasurementUnit
     *
     * @param array $measurementUnitFields
     * @return MeasurementUnit
     */
    public function fakeMeasurementUnit($measurementUnitFields = [])
    {
        return new MeasurementUnit($this->fakeMeasurementUnitData($measurementUnitFields));
    }

    /**
     * Get fake data of MeasurementUnit
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMeasurementUnitData($measurementUnitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'abreviation' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $measurementUnitFields);
    }
}
