<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderInfoRepository;
use App\Entities\OrderInfo;
use App\Validators\OrderInfoValidator;

/**
 * Class OrderInfoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderInfoRepositoryEloquent extends BaseRepository implements OrderInfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderInfo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrderInfoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    
    public function getByShowOrderId(string $showOrderId)
    {
        return OrderInfo::where('show_order_id', $showOrderId)->first();
    }
}
