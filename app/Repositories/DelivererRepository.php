<?php

namespace App\Repositories;

use App\Models\Deliverer;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DelivererRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:24 am UTC
 *
 * @method Deliverer findWithoutFail($id, $columns = ['*'])
 * @method Deliverer find($id, $columns = ['*'])
 * @method Deliverer first($columns = ['*'])
*/
class DelivererRepository extends BaseRepository
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
        return Deliverer::class;
    }
}
