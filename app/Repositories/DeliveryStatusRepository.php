<?php

namespace App\Repositories;

use App\Models\DeliveryStatus;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DeliveryStatusRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:14 am UTC
 *
 * @method DeliveryStatus findWithoutFail($id, $columns = ['*'])
 * @method DeliveryStatus find($id, $columns = ['*'])
 * @method DeliveryStatus first($columns = ['*'])
*/
class DeliveryStatusRepository extends BaseRepository
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
        return DeliveryStatus::class;
    }
}
