<?php

namespace App\Repositories;

use App\Models\Deliverer;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DelivererRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:30 am UTC
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
