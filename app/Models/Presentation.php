<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Presentation
 * @package App\Models
 * @version December 29, 2018, 12:32 am UTC
 *
 * @property \App\Models\Product product
 * @property \App\Models\MeasurementUnit measurementUnit
 * @property integer product_id
 * @property string slug
 * @property string short_name
 * @property string formal_name
 * @property double measurement_quantity
 * @property integer measurement_unit_id
 * @property double wholesale_price
 * @property double retail_price
 * @property integer minimum_stock_quantity
 * @property double iva
 * @property string image
 */
class Presentation extends Model
{
    use SoftDeletes;

    public $table = 'presentations';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'product_id',
        'slug',
        'short_name',
        'formal_name',
        'measurement_quantity',
        'measurement_unit_id',
        'wholesale_price',
        'retail_price',
        'minimum_stock_quantity',
        'iva',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'slug' => 'string',
        'short_name' => 'string',
        'formal_name' => 'string',
        'measurement_quantity' => 'double',
        'measurement_unit_id' => 'integer',
        'wholesale_price' => 'double',
        'retail_price' => 'double',
        'minimum_stock_quantity' => 'integer',
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

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'short_name' => 'required',
        'formal_name' => 'required',
        'measurement_quantity' => 'numeric',
        'wholesale_price' => 'numeric',
        'retail_price' => 'numeric',
        'minimum_stock_quantity' => 'numeric',
        'iva' => 'required,numeric'
    ];

	/**
	* @return A string which contains the text to be used in the select
	**/
	public function getLabelSelectAttribute() {
	    return "[" . $this->product->name . "] " . $this->formal_name . " (" . $this->measurement . ")";
	}

	/**
	* @return A string which contains the text to be used in the select
	**/
	public function getMeasurementAttribute() {
	    return $this->measurement_quantity . " " . $this->measurementUnit->abreviation ;
	}
	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function lots()
	{
		return $this->hasMany(\App\Models\Lot::class);
	}


	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function prelotOrders()
	{
		return $this->hasMany(\App\Models\PrelotOrder::class);
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
	public function orderItems()
	{
		return $this->hasMany(\App\Models\OrderItem::class);
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function measurementUnit()
    {
        return $this->belongsTo(\App\Models\MeasurementUnit::class);
    }
}
