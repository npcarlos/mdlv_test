<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DeliveryAddress
 * @package App\Models
 * @version December 29, 2018, 12:34 am UTC
 *
 * @property \App\Models\Customer customer
 * @property integer customer_id
 * @property string address
 * @property double latitude
 * @property double longitude
 */
class DeliveryAddress extends Model
{
    use SoftDeletes;

    public $table = 'delivery_addresses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'customer_id',
        'address',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_id' => 'integer',
        'address' => 'string',
        'latitude' => 'double',
        'longitude' => 'double'
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
        'latitude' => 'required,numeric',
        'longitude' => 'required,numeric'
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
	public function orders()
	{
		return $this->hasMany(\App\Models\Order::class);
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class);
    }
}
