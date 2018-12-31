<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SupplyOrder
 * @package App\Models
 * @version December 29, 2018, 12:31 am UTC
 *
 * @property \App\Models\Provider provider
 * @property \App\Models\Administrator administrator
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
