<?php

namespace App\Repositories;

use App\Models\Administrator;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AdministratorRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:30 am UTC
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
