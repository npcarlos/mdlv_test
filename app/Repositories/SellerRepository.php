<?php

namespace App\Repositories;

use App\Models\Seller;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SellerRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:19 am UTC
 *
 * @method Seller findWithoutFail($id, $columns = ['*'])
 * @method Seller find($id, $columns = ['*'])
 * @method Seller first($columns = ['*'])
*/
class SellerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uuid',
        'person_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Seller::class;
    }
}
