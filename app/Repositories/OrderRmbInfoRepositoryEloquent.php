<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderRmbInfoRepository;
use App\Entities\OrderRmbInfo;
use App\Validators\OrderRmbInfoValidator;

/**
 * Class OrderRmbInfoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderRmbInfoRepositoryEloquent extends BaseRepository implements OrderRmbInfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderRmbInfo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrderRmbInfoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
