<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class MeasurementUnit
 * @package App\Models
 * @version January 5, 2019, 3:13 am UTC
 *
 * @property string uuid
 * @property string name
 * @property string abreviation
 */
class MeasurementUnit extends Model
{
    use SoftDeletes;

    public $table = 'measurement_units';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'name',
        'abreviation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'name' => 'string',
        'abreviation' => 'string'
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
        'abreviation' => 'required'
    ];

	/**
	* @return A string which contains the text to be used in the select
	**/
	public function getLabelSelectAttribute() {
	    return $this->name . " (" . $this->abreviation . ")";
	}

	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function supplies()
	{
		return $this->hasMany(\App\Models\Supply::class);
	}


	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function presentations()
	{
		return $this->hasMany(\App\Models\Presentation::class);
	}


    
}
