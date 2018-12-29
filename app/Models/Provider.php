<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Provider
 * @package App\Models
 * @version December 29, 2018, 12:27 am UTC
 *
 * @property \App\Models\DocumentType documentType
 * @property string name
 * @property integer document_type_id
 * @property string document_number
 * @property string address
 * @property double latitude
 * @property double longitude
 * @property string phone
 * @property string cellphone
 * @property string web
 * @property string facebook_id
 * @property string instagram_id
 * @property string slug
 * @property string image
 */
class Provider extends Model
{
    use SoftDeletes;

    public $table = 'providers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'document_type_id' => 'integer',
        'document_number' => 'string',
        'address' => 'string',
        'latitude' => 'double',
        'longitude' => 'double',
        'phone' => 'string',
        'cellphone' => 'string',
        'web' => 'string',
        'facebook_id' => 'string',
        'instagram_id' => 'string',
        'slug' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'document_number' => 'required',
        'address' => 'nullable',
        'latitude' => 'numeric',
        'longitude' => 'numeric',
        'phone' => 'nullable',
        'cellphone' => 'nullable',
        'web' => 'nullable',
        'facebook_id' => 'nullable',
        'instagram_id' => 'nullable',
        'image' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function documentType()
    {
        return $this->belongsTo(\App\Models\DocumentType::class);
    }
}
