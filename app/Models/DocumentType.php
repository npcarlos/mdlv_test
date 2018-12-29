<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DocumentType
 * @package App\Models
 * @version December 29, 2018, 12:24 am UTC
 *
 * @property string longname
 * @property string name
 */
class DocumentType extends Model
{
    use SoftDeletes;

    public $table = 'document_types';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'longname',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'longname' => 'string',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'longname' => 'required',
        'name' => 'required'
    ];

    
}
