<?php

namespace App\Repositories;

use App\Models\SupplyOrder;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SupplyOrderRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:28 am UTC
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
        'uuid',
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
