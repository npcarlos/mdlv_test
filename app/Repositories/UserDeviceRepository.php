<?php

namespace App\Repositories;

use App\Models\UserDevice;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserDeviceRepository
 * @package App\Repositories
 * @version January 4, 2019, 10:31 pm UTC
 *
 * @method UserDevice findWithoutFail($id, $columns = ['*'])
 * @method UserDevice find($id, $columns = ['*'])
 * @method UserDevice first($columns = ['*'])
*/
class UserDeviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user',
        'token',
        'device'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserDevice::class;
    }
}
