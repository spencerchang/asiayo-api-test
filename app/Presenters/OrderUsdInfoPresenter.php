<?php

namespace App\Presenters;

use App\Transformers\OrderUsdInfoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderUsdInfoPresenter.
 *
 * @package namespace App\Presenters;
 */
class OrderUsdInfoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderUsdInfoTransformer();
    }
}
