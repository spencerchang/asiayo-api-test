<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OrderTwdInfo.
 *
 * @package namespace App\Entities;
 */
class OrderTwdInfo extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'order_twd_infos';
    
    protected $fillable = [];

    protected $guarded = [];

    protected $dates = ['deleted_at'];


}
