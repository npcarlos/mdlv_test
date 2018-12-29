<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Packager
 * @package App\Models
 * @version December 29, 2018, 12:29 am UTC
 *
 * @property \App\Models\Person person
 * @property integer person_id
 */
class Packager extends Model
{
    use SoftDeletes;

    public $table = 'packagers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'person_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'person_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function person()
    {
        return $this->belongsTo(\App\Models\Person::class);
    }
}
