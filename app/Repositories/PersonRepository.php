<?php

namespace App\Repositories;

use App\Models\Person;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:28 am UTC
 *
 * @method Person findWithoutFail($id, $columns = ['*'])
 * @method Person find($id, $columns = ['*'])
 * @method Person first($columns = ['*'])
*/
class PersonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'lastname',
        'birthday',
        'email',
        'password',
        'document_type_id',
        'document_number',
        'phone',
        'cellphone',
        'address',
        'nationality',
        'pictureLarge',
        'pictureMedium',
        'pictureThumbnail'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Person::class;
    }
}
