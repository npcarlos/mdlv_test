<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class Administrator
 * @package App\Models
 * @version January 5, 2019, 3:23 am UTC
 *
 * @property \App\Models\Person person
 * @property string uuid
 * @property integer person_id
 */
class Administrator extends Model
{
    use SoftDeletes;

    public $table = 'administrators';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'person_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
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
	

	public static function findByUUID($uuid)
	{
	    return Administrator::where('uuid', $uuid)->first()->makeVisible('id');
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
        
    ];

	/**
	* @return A string which contains the text to be used in the select
	**/
	public function getLabelSelectAttribute() {
	    return $this->person->fullname;
	}

	/**
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	**/
	public function supplyOrders()
	{
		return $this->hasMany(\App\Models\SupplyOrder::class);
	}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function person()
    {
        return $this->belongsTo(\App\Models\Person::class);
    }
}
