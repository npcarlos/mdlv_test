<?php

namespace App\Repositories;

use App\Models\Discount;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DiscountRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:15 am UTC
 *
 * @method Discount findWithoutFail($id, $columns = ['*'])
 * @method Discount find($id, $columns = ['*'])
 * @method Discount first($columns = ['*'])
*/
class DiscountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uuid',
        'name',
        'discount_percentage',
        'comments',
        'initial_date',
        'final_date',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Discount::class;
    }
}
