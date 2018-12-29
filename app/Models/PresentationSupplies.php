<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PresentationSupplies
 * @package App\Models
 * @version December 29, 2018, 12:33 am UTC
 *
 * @property \App\Models\Presentation presentation
 * @property \App\Models\Supply supply
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
        'presentation_id' => 'integer',
        'supply_id' => 'integer',
        'quantity' => 'integer'
    ];

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
