<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class PrelotOrder
 * @package App\Models
 * @version January 5, 2019, 3:36 am UTC
 *
 * @property \App\Models\Presentation presentation
 * @property \App\Models\Packager packager
 * @property \App\Models\PrelotStatus prelotStatus
 * @property \App\Models\Administrator administrator
 * @property string uuid
 * @property integer presentation_id
 * @property integer packager_id
 * @property integer prelot_status_id
 * @property integer requested_quantity
 * @property integer real_quantity
 * @property string|\Carbon\Carbon planned_packaging_date
 * @property string|\Carbon\Carbon packaged_date
 * @property string comments
 * @property integer administrator_id
 */
class PrelotOrder extends Model
{
    use SoftDeletes;

    public $table = 'prelot_orders';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'presentation_id',
        'packager_id',
        'prelot_status_id',
        'requested_quantity',
        'real_quantity',
        'planned_packaging_date',
        'packaged_date',
        'comments'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'presentation_id' => 'integer',
        'packager_id' => 'integer',
        'prelot_status_id' => 'integer',
        'requested_quantity' => 'integer',
        'real_quantity' => 'integer',
        'comments' => 'string',
        'administrator_id' => 'integer'
    ];
	

	protected $hidden = [
	    'id',
	    'created_at',
	    'updated_at',
	    'deleted_at'
	];
	

	protected $appends = [
	];
	

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
        'packager_id' => 'nullable',
        'prelot_status_id' => 'required',
        'requested_quantity' => 'numeric|required',
        'real_quantity' => 'numeric',
        'planned_packaging_date' => 'nullable',
        'packaged_date' => 'nullable',
        'administrator_id' => 'required'
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
	public function damagedSupplies()
	{
		return $this->hasMany(\App\Models\DamagedSupply::class);
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
    public function packager()
    {
        return $this->belongsTo(\App\Models\Packager::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function prelotStatus()
    {
        return $this->belongsTo(\App\Models\PrelotStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function administrator()
    {
        return $this->belongsTo(\App\Models\Administrator::class);
    }
}
