<?php

namespace App\Repositories;

use App\Models\MeasurementUnit;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MeasurementUnitRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:24 am UTC
 *
 * @method MeasurementUnit findWithoutFail($id, $columns = ['*'])
 * @method MeasurementUnit find($id, $columns = ['*'])
 * @method MeasurementUnit first($columns = ['*'])
*/
class MeasurementUnitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'abreviation'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MeasurementUnit::class;
    }
}
