<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Person
 * @package App\Models
 * @version December 29, 2018, 12:28 am UTC
 *
 * @property \App\Models\DocumentType documentType
 * @property string name
 * @property string lastname
 * @property date birthday
 * @property string email
 * @property string password
 * @property integer document_type_id
 * @property string document_number
 * @property string phone
 * @property string cellphone
 * @property string address
 * @property string nationality
 * @property string pictureLarge
 * @property string pictureMedium
 * @property string pictureThumbnail
 */
class Person extends Model
{
    use SoftDeletes;

    public $table = 'people';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'lastname',
        'birthday',
        'email',
        'password',
        'document_type_id',
        'document_number',
        'phone',
        'cellphone',
        'address',
        'nationality',
        'pictureLarge',
        'pictureMedium',
        'pictureThumbnail'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'lastname' => 'string',
        'birthday' => 'date',
        'email' => 'string',
        'password' => 'string',
        'document_type_id' => 'integer',
        'document_number' => 'string',
        'phone' => 'string',
        'cellphone' => 'string',
        'address' => 'string',
        'nationality' => 'string',
        'pictureLarge' => 'string',
        'pictureMedium' => 'string',
        'pictureThumbnail' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'lastname' => 'required',
        'birthday' => 'required',
        'email' => 'required,unique',
        'password' => 'required',
        'document_type_id' => 'required',
        'document_number' => 'required,numeric',
        'phone' => 'nullable',
        'cellphone' => 'nullable',
        'address' => 'required',
        'nationality' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function documentType()
    {
        return $this->belongsTo(\App\Models\DocumentType::class);
    }
}
