<?php

namespace App\Presenters;

use App\Transformers\OrderInfoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderInfoPresenter.
 *
 * @package namespace App\Presenters;
 */
class OrderInfoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderInfoTransformer();
    }
}
