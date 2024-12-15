<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OrderMyrInfo.
 *
 * @package namespace App\Entities;
 */
class OrderMyrInfo extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'order_myr_infos';
    
    protected $fillable = [];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

}
