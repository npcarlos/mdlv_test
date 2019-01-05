<?php

namespace App\Repositories;

use App\Models\DamagedSupply;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DamagedSupplyRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:40 am UTC
 *
 * @method DamagedSupply findWithoutFail($id, $columns = ['*'])
 * @method DamagedSupply find($id, $columns = ['*'])
 * @method DamagedSupply first($columns = ['*'])
*/
class DamagedSupplyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uuid',
        'supply_id',
        'prelot_order_id',
        'quantity',
        'damage_description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DamagedSupply::class;
    }
}
