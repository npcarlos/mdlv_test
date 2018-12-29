<?php

namespace App\Repositories;

use App\Models\Presentation;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PresentationRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:32 am UTC
 *
 * @method Presentation findWithoutFail($id, $columns = ['*'])
 * @method Presentation find($id, $columns = ['*'])
 * @method Presentation first($columns = ['*'])
*/
class PresentationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'slug',
        'short_name',
        'formal_name',
        'measurement_quantity',
        'measurement_unit_id',
        'wholesale_price',
        'retail_price',
        'minimum_stock_quantity',
        'iva',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Presentation::class;
    }
}
