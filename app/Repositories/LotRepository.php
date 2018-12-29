<?php

namespace App\Repositories;

use App\Models\Lot;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LotRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:32 am UTC
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
