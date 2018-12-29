<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DamagedSupply
 * @package App\Models
 * @version December 29, 2018, 12:34 am UTC
 *
 * @property \App\Models\Supply supply
 * @property \App\Models\PrelotOrder prelotOrder
 * @property integer supply_id
 * @property integer prelot_order_id
 * @property integer quantity
 * @property string damage_description
 */
class DamagedSupply extends Model
{
    use SoftDeletes;

    public $table = 'damaged_supplies';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'supply_id',
        'prelot_order_id',
        'quantity',
        'damage_description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'supply_id' => 'integer',
        'prelot_order_id' => 'integer',
        'quantity' => 'integer',
        'damage_description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'prelot_order_id' => 'required',
        'quantity' => 'numeric',
        'damage_description' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function supply()
    {
        return $this->belongsTo(\App\Models\Supply::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function prelotOrder()
    {
        return $this->belongsTo(\App\Models\PrelotOrder::class);
    }
}
