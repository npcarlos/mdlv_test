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
