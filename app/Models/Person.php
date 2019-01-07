<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class Person
 * @package App\Models
 * @version January 5, 2019, 3:17 am UTC
 *
 * @property \App\Models\DocumentType documentType
 * @property string uuid
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
        'uuid',
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
        'uuid' => 'string',
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
	

	protected $hidden = [
	    'id',
	    'created_at',
	    'updated_at',
	    'deleted_at'
	];
	

	protected $appends = [
	];
	

	public static function findByUUID($uuid)
	{
	    return Person::where('uuid', $uuid)->first()->makeVisible('id');
	}
	

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
	* @return A string which contains the text to be used in the select
	**/
	public function getLabelSelectAttribute() {
	    return $this->fullname;
	}
    
    
	/**
	* @return A string which contains the text to be used in the select
	**/
	public function getFullnameAttribute() {
	    return $this->name . " " . $this->lastname;
	}

	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function packagers()
	{
		return $this->hasMany(\App\Models\Packager::class);
	}


	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function sellers()
	{
		return $this->hasMany(\App\Models\Seller::class);
	}


	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function administrators()
	{
		return $this->hasMany(\App\Models\Administrator::class);
	}


	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function deliverers()
	{
		return $this->hasMany(\App\Models\Deliverer::class);
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function documentType()
    {
        return $this->belongsTo(\App\Models\DocumentType::class);
    }
}
