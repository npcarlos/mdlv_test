<?php

namespace App\Repositories;

use App\Models\Packager;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PackagerRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:29 am UTC
 *
 * @method Packager findWithoutFail($id, $columns = ['*'])
 * @method Packager find($id, $columns = ['*'])
 * @method Packager first($columns = ['*'])
*/
class PackagerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'person_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Packager::class;
    }
}
