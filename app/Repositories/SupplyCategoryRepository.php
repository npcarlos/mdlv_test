<?php

namespace App\Repositories;

use App\Models\SupplyCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SupplyCategoryRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:25 am UTC
 *
 * @method SupplyCategory findWithoutFail($id, $columns = ['*'])
 * @method SupplyCategory find($id, $columns = ['*'])
 * @method SupplyCategory first($columns = ['*'])
*/
class SupplyCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SupplyCategory::class;
    }
}
