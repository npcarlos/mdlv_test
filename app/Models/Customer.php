<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class Customer
 * @package App\Models
 * @version January 5, 2019, 3:16 am UTC
 *
 * @property \App\Models\DocumentType documentType
 * @property string uuid
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
class Customer extends Model
{
    use SoftDeletes;

    public $table = 'customers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
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
        'uuid' => 'string',
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
	

	protected $hidden = [
	    'id',
	    'created_at',
	    'updated_at',
	    'deleted_at'
	];
	

	protected $appends = [
	];
	

	public static function boot()
	{
	    parent::boot();
	
	    static::saving(function($image){
	        if(!isset($image->attributes['uuid']))  {
	            $image->attributes['uuid'] = Str::uuid();
	        }
	    });
	}

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'document_type_id' => 'required',
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
	* @return A string which contains the text to be used in the select
	**/
	public function getLabelSelectAttribute() {
	    return $this->name;
	}

	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function deliveryAddresses()
	{
		return $this->hasMany(\App\Models\DeliveryAddress::class);
	}


	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function orders()
	{
		return $this->hasMany(\App\Models\Order::class);
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function documentType()
    {
        return $this->belongsTo(\App\Models\DocumentType::class);
    }
}
