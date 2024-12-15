<?php

namespace App\Presenters;

use App\Transformers\OrderMyrInfoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderMyrInfoPresenter.
 *
 * @package namespace App\Presenters;
 */
class OrderMyrInfoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderMyrInfoTransformer();
    }
}
