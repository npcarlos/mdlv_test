<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lot
 * @package App\Models
 * @version December 29, 2018, 12:32 am UTC
 *
 * @property \App\Models\Presentation presentation
 * @property \App\Models\Packager packager
 * @property integer presentation_id
 * @property integer packager_id
 * @property integer quantity
 * @property date production_date
 * @property string slug
 */
class Lot extends Model
{
    use SoftDeletes;

    public $table = 'lots';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'presentation_id',
        'packager_id',
        'quantity',
        'production_date',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'presentation_id' => 'integer',
        'packager_id' => 'integer',
        'quantity' => 'integer',
        'production_date' => 'date',
        'slug' => 'string'
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
        'presentation_id' => 'required',
        'packager_id' => 'required',
        'quantity' => 'required,numeric',
        'production_date' => 'required'
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
    public function packager()
    {
        return $this->belongsTo(\App\Models\Packager::class);
    }
}
