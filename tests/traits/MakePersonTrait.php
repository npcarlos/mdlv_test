<?php

use Faker\Factory as Faker;
use App\Models\Person;
use App\Repositories\PersonRepository;

trait MakePersonTrait
{
    /**
     * Create fake instance of Person and save it in database
     *
     * @param array $personFields
     * @return Person
     */
    public function makePerson($personFields = [])
    {
        /** @var PersonRepository $personRepo */
        $personRepo = App::make(PersonRepository::class);
        $theme = $this->fakePersonData($personFields);
        return $personRepo->create($theme);
    }

    /**
     * Get fake instance of Person
     *
     * @param array $personFields
     * @return Person
     */
    public function fakePerson($personFields = [])
    {
        return new Person($this->fakePersonData($personFields));
    }

    /**
     * Get fake data of Person
     *
     * @param array $postFields
     * @return array
     */
    public function fakePersonData($personFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'uuid' => $fake->word,
            'name' => $fake->word,
            'lastname' => $fake->word,
            'birthday' => $fake->word,
            'email' => $fake->word,
            'password' => $fake->word,
            'document_type_id' => $fake->randomDigitNotNull,
            'document_number' => $fake->word,
            'phone' => $fake->word,
            'cellphone' => $fake->word,
            'address' => $fake->word,
            'nationality' => $fake->word,
            'pictureLarge' => $fake->word,
            'pictureMedium' => $fake->word,
            'pictureThumbnail' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $personFields);
    }
}
