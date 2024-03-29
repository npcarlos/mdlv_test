<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class Supply
 * @package App\Models
 * @version January 5, 2019, 3:25 am UTC
 *
 * @property \App\Models\SupplyCategory supplyCategory
 * @property \App\Models\Provider provider
 * @property \App\Models\MeasurementUnit measurementUnit
 * @property string uuid
 * @property integer supply_category_id
 * @property string name
 * @property string slug
 * @property integer provider_id
 * @property double measurement_quantity
 * @property integer measurement_unit_id
 * @property integer minimum_stock_quantity
 * @property integer stock_quantity
 * @property integer minimum_quantity
 * @property double unitary_value
 * @property double iva
 * @property string image
 */
class Supply extends Model
{
    use SoftDeletes;

    public $table = 'supplies';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'supply_category_id',
        'name',
        'slug',
        'provider_id',
        'measurement_quantity',
        'measurement_unit_id',
        'minimum_stock_quantity',
        'stock_quantity',
        'minimum_quantity',
        'unitary_value',
        'iva',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'supply_category_id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'provider_id' => 'integer',
        'measurement_quantity' => 'double',
        'measurement_unit_id' => 'integer',
        'minimum_stock_quantity' => 'integer',
        'stock_quantity' => 'integer',
        'minimum_quantity' => 'integer',
        'unitary_value' => 'double',
        'iva' => 'double',
        'image' => 'string'
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
	    return Supply::where('uuid', $uuid)->first()->makeVisible('id');
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
        'provider_id' => 'required',
        'measurement_quantity' => 'numeric',
        'measurement_unit_id' => 'required',
        'minimum_stock_quantity' => 'required,numeric',
        'stock_quantity' => 'required,numeric',
        'minimum_quantity' => 'numeric',
        'unitary_value' => 'numeric',
        'iva' => 'numeric',
        'image' => 'nullable'
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
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function presentationSupplies()
	{
		return $this->hasMany(\App\Models\PresentationSupplies::class);
	}


	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function damagedSupplies()
	{
		return $this->hasMany(\App\Models\DamagedSupply::class);
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function supplyCategory()
    {
        return $this->belongsTo(\App\Models\SupplyCategory::class);
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
    public function measurementUnit()
    {
        return $this->belongsTo(\App\Models\MeasurementUnit::class);
    }
}
