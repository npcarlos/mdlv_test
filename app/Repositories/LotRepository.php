<?php

namespace App\Repositories;

use App\Models\Lot;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LotRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:35 am UTC
 *
 * @method Lot findWithoutFail($id, $columns = ['*'])
 * @method Lot find($id, $columns = ['*'])
 * @method Lot first($columns = ['*'])
*/
class LotRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uuid',
        'presentation_id',
        'packager_id',
        'quantity',
        'production_date',
        'slug'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Lot::class;
    }
}
