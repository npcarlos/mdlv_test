<?php

namespace App\Repositories;

use App\Models\PrelotOrder;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PrelotOrderRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:36 am UTC
 *
 * @method PrelotOrder findWithoutFail($id, $columns = ['*'])
 * @method PrelotOrder find($id, $columns = ['*'])
 * @method PrelotOrder first($columns = ['*'])
*/
class PrelotOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uuid',
        'presentation_id',
        'packager_id',
        'prelot_status_id',
        'requested_quantity',
        'real_quantity',
        'planned_packaging_date',
        'packaged_date',
        'comments',
        'administrator_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PrelotOrder::class;
    }
}
