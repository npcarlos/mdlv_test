<?php

namespace App\Repositories;

use App\Models\Provider;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProviderRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:27 am UTC
 *
 * @method Provider findWithoutFail($id, $columns = ['*'])
 * @method Provider find($id, $columns = ['*'])
 * @method Provider first($columns = ['*'])
*/
class ProviderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'document_type_id',
        'document_number',
        'address',
        'latitude',
        'longitude',
        'phone',
        'cellphone',
        'web',
        'facebook_id',
        'instagram_id',
        'slug',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Provider::class;
    }
}
