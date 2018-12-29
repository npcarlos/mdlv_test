<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderItem
 * @package App\Models
 * @version December 29, 2018, 12:35 am UTC
 *
 * @property \App\Models\Order order
 * @property \App\Models\Presentation presentation
 * @property \App\Models\Discount discount
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
        'order_id' => 'integer',
        'presentation_id' => 'integer',
        'quantity' => 'integer',
        'discount_id' => 'integer'
    ];

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
