<?php

namespace App\Repositories;

use App\Models\DocumentType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DocumentTypeRepository
 * @package App\Repositories
 * @version December 29, 2018, 12:24 am UTC
 *
 * @method DocumentType findWithoutFail($id, $columns = ['*'])
 * @method DocumentType find($id, $columns = ['*'])
 * @method DocumentType first($columns = ['*'])
*/
class DocumentTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'longname',
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DocumentType::class;
    }
}
