<?php

namespace App\Repositories;

use App\Models\DeliveryAddress;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DeliveryAddressRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:34 am UTC
 *
 * @method DeliveryAddress findWithoutFail($id, $columns = ['*'])
 * @method DeliveryAddress find($id, $columns = ['*'])
 * @method DeliveryAddress first($columns = ['*'])
*/
class DeliveryAddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'customer_id',
        'address',
        'latitude',
        'longitude'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DeliveryAddress::class;
    }
}
