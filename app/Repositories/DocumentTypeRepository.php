<?php

namespace App\Repositories;

use App\Models\DocumentType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DocumentTypeRepository
 * @package App\Repositories
 * @version January 5, 2019, 3:13 am UTC
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
        'uuid',
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
