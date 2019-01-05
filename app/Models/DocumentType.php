<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class DocumentType
 * @package App\Models
 * @version January 5, 2019, 3:13 am UTC
 *
 * @property string uuid
 * @property string longname
 * @property string name
 */
class DocumentType extends Model
{
    use SoftDeletes;

    public $table = 'document_types';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'longname',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'longname' => 'string',
        'name' => 'string'
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
        'longname' => 'required',
        'name' => 'required'
    ];

	/**
	* @return A string which contains the text to be used in the select
	**/
	public function getLabelSelectAttribute() {
	    return $this->longname . " (" . $this->name . ")";
	}

	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function providers()
	{
		return $this->hasMany(\App\Models\Provider::class);
	}


	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function customers()
	{
		return $this->hasMany(\App\Models\Customer::class);
	}


	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function people()
	{
		return $this->hasMany(\App\Models\Person::class);
	}


    
}
