<?php

namespace App\Presenters;

use App\Transformers\OrderRmbInfoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderRmbInfoPresenter.
 *
 * @package namespace App\Presenters;
 */
class OrderRmbInfoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderRmbInfoTransformer();
    }
}
