<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class PaymentStatus
 * @package App\Models
 * @version January 5, 2019, 3:14 am UTC
 *
 * @property string uuid
 * @property string name
 */
class PaymentStatus extends Model
{
    use SoftDeletes;

    public $table = 'payment_statuses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'name' => 'string'
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
	    return PaymentStatus::where('uuid', $uuid)->first()->makeVisible('id');
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
        'name' => 'required'
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
	public function orders()
	{
		return $this->hasMany(\App\Models\Order::class);
	}


    
}
