<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderTwdInfoRepository;
use App\Entities\OrderTwdInfo;
use App\Validators\OrderTwdInfoValidator;

/**
 * Class OrderTwdInfoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderTwdInfoRepositoryEloquent extends BaseRepository implements OrderTwdInfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderTwdInfo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrderTwdInfoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
