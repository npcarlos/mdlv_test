<?php

namespace App\Repositories;

use App\Models\Supply;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SupplyRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:25 am UTC
 *
 * @method Supply findWithoutFail($id, $columns = ['*'])
 * @method Supply find($id, $columns = ['*'])
 * @method Supply first($columns = ['*'])
*/
class SupplyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uuid',
        'supply_category_id',
        'name',
        'slug',
        'provider_id',
        'measurement_quantity',
        'measurement_unit_id',
        'minimum_stock_quantity',
        'stock_quantity',
        'minimum_quantity',
        'unitary_value',
        'iva',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Supply::class;
    }
}
