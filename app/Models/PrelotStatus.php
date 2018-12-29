<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PrelotStatus
 * @package App\Models
 * @version December 29, 2018, 12:26 am UTC
 *
 * @property string name
 */
class PrelotStatus extends Model
{
    use SoftDeletes;

    public $table = 'prelot_statuses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
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
	public function prelotOrders()
	{
		return $this->hasMany(\App\Models\PrelotOrder::class);
	}


    
}
