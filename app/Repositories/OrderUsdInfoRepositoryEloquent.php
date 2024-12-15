<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderUsdInfoRepository;
use App\Entities\OrderUsdInfo;
use App\Validators\OrderUsdInfoValidator;

/**
 * Class OrderUsdInfoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderUsdInfoRepositoryEloquent extends BaseRepository implements OrderUsdInfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderUsdInfo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrderUsdInfoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
