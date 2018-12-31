<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Deliverer
 * @package App\Models
 * @version December 29, 2018, 12:30 am UTC
 *
 * @property \App\Models\Person person
 * @property integer person_id
 */
class Deliverer extends Model
{
    use SoftDeletes;

    public $table = 'deliverers';
    

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
        
    ];

	/**
	* @return A string which contains the text to be used in the select
	**/
	public function getLabelSelectAttribute() {
	    return $this->person->name;
	}

	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function orders()
	{
		return $this->hasMany(\App\Models\Order::class);
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function person()
    {
        return $this->belongsTo(\App\Models\Person::class);
    }
}
