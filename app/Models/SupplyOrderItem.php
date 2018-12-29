<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SupplyOrderItem
 * @package App\Models
 * @version December 29, 2018, 12:31 am UTC
 *
 * @property \App\Models\SupplyOrder supplyOrder
 * @property \App\Models\Supply supply
 * @property integer supply_order_id
 * @property integer supply_id
 * @property integer quantity
 */
class SupplyOrderItem extends Model
{
    use SoftDeletes;

    public $table = 'supply_order_items';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'supply_order_id',
        'supply_id',
        'quantity'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'supply_order_id' => 'integer',
        'supply_id' => 'integer',
        'quantity' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'supply_order_id' => 'required',
        'supply_id' => 'required',
        'quantity' => 'numeric,required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function supplyOrder()
    {
        return $this->belongsTo(\App\Models\SupplyOrder::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function supply()
    {
        return $this->belongsTo(\App\Models\Supply::class);
    }
}
