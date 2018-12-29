<?php

namespace App\Repositories;

use App\Models\Discount;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DiscountRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:26 am UTC
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
