<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class DeliveryAddress
 * @package App\Models
 * @version January 5, 2019, 3:40 am UTC
 *
 * @property \App\Models\Customer customer
 * @property string uuid
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
        'uuid',
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
        'uuid' => 'string',
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
