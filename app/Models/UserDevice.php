<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class UserDevice
 * @package App\Models
 * @version January 5, 2019, 3:09 am UTC
 *
 * @property string uuid
 * @property string user
 * @property string token
 * @property string device
 */
class UserDevice extends Model
{
    use SoftDeletes;

    public $table = 'user_devices';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'user',
        'token',
        'device'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'user' => 'string',
        'token' => 'string',
        'device' => 'string'
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
        'token' => 'nullable',
        'device' => 'nullable'
    ];

    
}
