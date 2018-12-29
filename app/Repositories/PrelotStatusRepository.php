<?php

namespace App\Repositories;

use App\Models\PrelotStatus;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PrelotStatusRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:26 am UTC
 *
 * @method PrelotStatus findWithoutFail($id, $columns = ['*'])
 * @method PrelotStatus find($id, $columns = ['*'])
 * @method PrelotStatus first($columns = ['*'])
*/
class PrelotStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PrelotStatus::class;
    }
}
