<?php

namespace App\Repositories;

use App\Models\Packager;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PackagerRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:17 am UTC
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
        'uuid',
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
