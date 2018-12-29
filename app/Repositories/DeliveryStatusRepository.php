<?php

namespace App\Repositories;

use App\Models\DeliveryStatus;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DeliveryStatusRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:26 am UTC
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
