<?php

namespace App\Repositories;

use App\Models\PaymentStatus;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PaymentStatusRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:25 am UTC
 *
 * @method PaymentStatus findWithoutFail($id, $columns = ['*'])
 * @method PaymentStatus find($id, $columns = ['*'])
 * @method PaymentStatus first($columns = ['*'])
*/
class PaymentStatusRepository extends BaseRepository
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
        return PaymentStatus::class;
    }
}
