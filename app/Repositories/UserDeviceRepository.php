<?php

namespace App\Repositories;

use App\Models\UserDevice;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserDeviceRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:09 am UTC
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
        'uuid',
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
