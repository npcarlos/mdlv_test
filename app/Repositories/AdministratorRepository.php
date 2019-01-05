<?php

namespace App\Repositories;

use App\Models\Administrator;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AdministratorRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:23 am UTC
 *
 * @method Administrator findWithoutFail($id, $columns = ['*'])
 * @method Administrator find($id, $columns = ['*'])
 * @method Administrator first($columns = ['*'])
*/
class AdministratorRepository extends BaseRepository
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
        return Administrator::class;
    }
}
