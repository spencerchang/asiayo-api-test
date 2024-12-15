<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderMyrInfoRepository;
use App\Entities\OrderMyrInfo;
use App\Validators\OrderMyrInfoValidator;

/**
 * Class OrderMyrInfoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderMyrInfoRepositoryEloquent extends BaseRepository implements OrderMyrInfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderMyrInfo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrderMyrInfoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
