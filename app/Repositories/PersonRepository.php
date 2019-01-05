<?php

namespace App\Repositories;

use App\Models\Person;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:17 am UTC
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
        'uuid',
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
