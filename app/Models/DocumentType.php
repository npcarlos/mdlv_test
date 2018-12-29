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
