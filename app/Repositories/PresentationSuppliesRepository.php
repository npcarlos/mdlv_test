<?php

namespace App\Repositories;

use App\Models\PresentationSupplies;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PresentationSuppliesRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:33 am UTC
 *
 * @method PresentationSupplies findWithoutFail($id, $columns = ['*'])
 * @method PresentationSupplies find($id, $columns = ['*'])
 * @method PresentationSupplies first($columns = ['*'])
*/
class PresentationSuppliesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'presentation_id',
        'supply_id',
        'quantity'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PresentationSupplies::class;
    }
}
