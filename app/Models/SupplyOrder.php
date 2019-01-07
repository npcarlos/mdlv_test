<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class SupplyOrder
 * @package App\Models
 * @version January 5, 2019, 3:28 am UTC
 *
 * @property \App\Models\Provider provider
 * @property \App\Models\Administrator administrator
 * @property string uuid
 * @property integer provider_id
 * @property integer administrator_id
 * @property string comments
 */
class SupplyOrder extends Model
{
    use SoftDeletes;

    public $table = 'supply_orders';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'provider_id',
        'administrator_id',
        'comments'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'provider_id' => 'integer',
        'administrator_id' => 'integer',
        'comments' => 'string'
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
	    return SupplyOrder::where('uuid', $uuid)->first()->makeVisible('id');
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
	public function supplyOrderItems()
	{
		return $this->hasMany(\App\Models\SupplyOrderItem::class);
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function provider()
    {
        return $this->belongsTo(\App\Models\Provider::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function administrator()
    {
        return $this->belongsTo(\App\Models\Administrator::class);
    }
}
