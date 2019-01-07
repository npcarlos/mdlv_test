<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class Order
 * @package App\Models
 * @version January 5, 2019, 3:41 am UTC
 *
 * @property \App\Models\Customer customer
 * @property \App\Models\Seller seller
 * @property \App\Models\PaymentStatus paymentStatus
 * @property \App\Models\DeliveryStatus deliveryStatus
 * @property \App\Models\Deliverer deliverer
 * @property \App\Models\DeliveryAddress deliveryAddress
 * @property string uuid
 * @property integer customer_id
 * @property integer seller_id
 * @property integer payment_status_id
 * @property integer delivery_status_id
 * @property integer deliverer_id
 * @property date planned_delivery_date
 * @property string|\Carbon\Carbon delivery_date
 * @property integer delivery_address_id
 * @property string comments
 */
class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'customer_id',
        'seller_id',
        'payment_status_id',
        'delivery_status_id',
        'deliverer_id',
        'planned_delivery_date',
        'delivery_date',
        'delivery_address_id',
        'comments'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'customer_id' => 'integer',
        'seller_id' => 'integer',
        'payment_status_id' => 'integer',
        'delivery_status_id' => 'integer',
        'deliverer_id' => 'integer',
        'planned_delivery_date' => 'date',
        'delivery_address_id' => 'integer',
        'comments' => 'string'
    ];
	

	protected $hidden = [
	    'id',
	    'created_at',
	    'updated_at',
	    'deleted_at',
        'customer_id',
        'seller_id',
        'payment_status_id',
        'delivery_status_id',
        'deliverer_id'
	];
	

	protected $appends = [
        
	];
	

	public static function findByUUID($uuid)
	{
	    return Order::where('uuid', $uuid)->first()->makeVisible('id');
	}
	
	public static function findByUUIDWith($uuid, $with)
	{
	    return Order::where('uuid', $uuid)->with($with)->first();
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
        //'customer_id' => 'required',
        //'seller_id' => 'required',
        //'payment_status_id' => 'required',
        //'delivery_status_id' => 'required',
        'planned_delivery_date' => 'nullable',
        'delivery_date' => 'nullable',
        'comments' => 'nullable'
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
	public function orderItems()
	{
		return $this->hasMany(\App\Models\OrderItem::class);
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function seller()
    {
        return $this->belongsTo(\App\Models\Seller::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function paymentStatus()
    {
        return $this->belongsTo(\App\Models\PaymentStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function deliveryStatus()
    {
        return $this->belongsTo(\App\Models\DeliveryStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function deliverer()
    {
        return $this->belongsTo(\App\Models\Deliverer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function deliveryAddress()
    {
        return $this->belongsTo(\App\Models\DeliveryAddress::class);
    }
}
