<?php

namespace App\Repositories;

use App\Models\SupplyCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SupplyCategoryRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:14 am UTC
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
        'uuid',
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
