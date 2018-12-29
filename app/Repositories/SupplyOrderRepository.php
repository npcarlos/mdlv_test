<?php

namespace App\Repositories;

use App\Models\SupplyOrder;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SupplyOrderRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:31 am UTC
 *
 * @method SupplyOrder findWithoutFail($id, $columns = ['*'])
 * @method SupplyOrder find($id, $columns = ['*'])
 * @method SupplyOrder first($columns = ['*'])
*/
class SupplyOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'provider_id',
        'administrator_id',
        'comments'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SupplyOrder::class;
    }
}
