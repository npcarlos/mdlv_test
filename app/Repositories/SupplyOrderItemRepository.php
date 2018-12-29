<?php

namespace App\Repositories;

use App\Models\SupplyOrderItem;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SupplyOrderItemRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:31 am UTC
 *
 * @method SupplyOrderItem findWithoutFail($id, $columns = ['*'])
 * @method SupplyOrderItem find($id, $columns = ['*'])
 * @method SupplyOrderItem first($columns = ['*'])
*/
class SupplyOrderItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'supply_order_id',
        'supply_id',
        'quantity'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SupplyOrderItem::class;
    }
}
