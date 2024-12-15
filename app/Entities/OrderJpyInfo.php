<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OrderJpyInfo.
 *
 * @package namespace App\Entities;
 */
class OrderJpyInfo extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'order_jpy_infos';
    
    protected $fillable = [];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

}
