<?php

namespace App\Repositories;

use App\Models\MeasurementUnit;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MeasurementUnitRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:13 am UTC
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
        'uuid',
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
