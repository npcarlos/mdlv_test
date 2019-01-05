<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class PresentationSupplies
 * @package App\Models
 * @version January 5, 2019, 3:40 am UTC
 *
 * @property \App\Models\Presentation presentation
 * @property \App\Models\Supply supply
 * @property string uuid
 * @property integer presentation_id
 * @property integer supply_id
 * @property integer quantity
 */
class PresentationSupplies extends Model
{
    use SoftDeletes;

    public $table = 'presentation_supplies';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'presentation_id',
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
        'presentation_id' => 'integer',
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
        'quantity' => 'numeric'
    ];

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
    public function supply()
    {
        return $this->belongsTo(\App\Models\Supply::class);
    }
}
