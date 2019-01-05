<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserDevice
 * @package App\Models
 * @version January 4, 2019, 10:31 pm UTC
 *
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
        'user' => 'string',
        'token' => 'string',
        'device' => 'string'
    ];

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
