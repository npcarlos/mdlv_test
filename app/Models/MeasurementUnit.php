<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MeasurementUnit
 * @package App\Models
 * @version December 29, 2018, 12:24 am UTC
 *
 * @property string name
 * @property string abreviation
 */
class MeasurementUnit extends Model
{
    use SoftDeletes;

    public $table = 'measurement_units';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'abreviation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'abreviation' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'abreviation' => 'required'
    ];

    
}
