<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MeasurementUnit
 * @package App\Models
 * @version December 29, 2018, 12:24 am UTC
 *
 * @property string name
 * @property string abreviation
 */
class MeasurementUnit extends Model
{
    use SoftDeletes;

    public $table = 'measurement_units';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'abreviation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
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
