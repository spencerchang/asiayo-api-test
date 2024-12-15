<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderJpyInfoRepository;
use App\Entities\OrderJpyInfo;
use App\Validators\OrderJpyInfoValidator;

/**
 * Class OrderJpyInfoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderJpyInfoRepositoryEloquent extends BaseRepository implements OrderJpyInfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderJpyInfo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrderJpyInfoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
