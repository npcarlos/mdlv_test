<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class OrderItem
 * @package App\Models
 * @version January 5, 2019, 3:41 am UTC
 *
 * @property \App\Models\Order order
 * @property \App\Models\Presentation presentation
 * @property \App\Models\Discount discount
 * @property string uuid
 * @property integer order_id
 * @property integer presentation_id
 * @property integer quantity
 * @property integer discount_id
 */
class OrderItem extends Model
{
    use SoftDeletes;

    public $table = 'order_items';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'order_id',
        'presentation_id',
        'quantity',
        'discount_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'order_id' => 'integer',
        'presentation_id' => 'integer',
        'quantity' => 'integer',
        'discount_id' => 'integer'
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
	    return OrderItem::where('uuid', $uuid)->first()->makeVisible('id');
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
        'quantity' => 'numeric,required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function presentation()
    {
        return $this->belongsTo(\App\Models\Presentation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function discount()
    {
        return $this->belongsTo(\App\Models\Discount::class);
    }
}
