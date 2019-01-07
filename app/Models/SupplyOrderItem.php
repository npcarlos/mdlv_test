<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class SupplyOrderItem
 * @package App\Models
 * @version January 5, 2019, 3:33 am UTC
 *
 * @property \App\Models\SupplyOrder supplyOrder
 * @property \App\Models\Supply supply
 * @property string uuid
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
        'uuid',
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
        'uuid' => 'string',
        'supply_order_id' => 'integer',
        'supply_id' => 'integer',
        'quantity' => 'integer'
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
	    return SupplyOrderItem::where('uuid', $uuid)->first()->makeVisible('id');
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
