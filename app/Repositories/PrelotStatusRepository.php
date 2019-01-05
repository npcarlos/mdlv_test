<?php

namespace App\Repositories;

use App\Models\PrelotStatus;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PrelotStatusRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:15 am UTC
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
        'uuid',
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
