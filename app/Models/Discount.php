<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;




/**
 * Class Discount
 * @package App\Models
 * @version January 5, 2019, 3:15 am UTC
 *
 * @property string uuid
 * @property string name
 * @property integer discount_percentage
 * @property string comments
 * @property string|\Carbon\Carbon initial_date
 * @property string|\Carbon\Carbon final_date
 * @property string image
 */
class Discount extends Model
{
    use SoftDeletes;

    public $table = 'discounts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'uuid',
        'name',
        'discount_percentage',
        'comments',
        'initial_date',
        'final_date',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'name' => 'string',
        'discount_percentage' => 'integer',
        'comments' => 'string',
        'image' => 'string'
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
	    return Discount::where('uuid', $uuid)->first()->makeVisible('id');
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
        'name' => 'required',
        'discount_percentage' => 'numeric',
        'comments' => 'nullable',
        'initial_date' => 'nullable',
        'final_date' => 'nullable',
        'image' => 'nullable'
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
	public function orderItems()
	{
		return $this->hasMany(\App\Models\OrderItem::class);
	}


    
}
