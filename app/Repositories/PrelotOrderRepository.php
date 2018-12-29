<?php

namespace App\Repositories;

use App\Models\PrelotOrder;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PrelotOrderRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:33 am UTC
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
        'presentation_id',
        'packager_id',
        'prelot_status_id',
        'requested_quantity',
        'real_quantity',
        'planned_packaging_date',
        'packaged_date',
        'comments'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PrelotOrder::class;
    }
}
