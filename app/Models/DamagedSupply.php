<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class DamagedSupply
 * @package App\Models
 * @version January 5, 2019, 3:40 am UTC
 *
 * @property \App\Models\Supply supply
 * @property \App\Models\PrelotOrder prelotOrder
 * @property string uuid
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
        'uuid',
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
        'uuid' => 'string',
        'supply_id' => 'integer',
        'prelot_order_id' => 'integer',
        'quantity' => 'integer',
        'damage_description' => 'string'
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
	    return DamagedSupply::where('uuid', $uuid)->first()->makeVisible('id');
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
