<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Administrator
 * @package App\Models
 * @version December 29, 2018, 12:30 am UTC
 *
 * @property \App\Models\Person person
 * @property integer person_id
 */
class Administrator extends Model
{
    use SoftDeletes;

    public $table = 'administrators';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'person_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'person_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

	/**
	* @return A string which contains the text to be used in the select
	**/
	public function getLabelSelectAttribute() {
	    return $this->person->fullname;
	}

	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function supplyOrders()
	{
		return $this->hasMany(\App\Models\SupplyOrder::class);
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function person()
    {
        return $this->belongsTo(\App\Models\Person::class);
    }
}