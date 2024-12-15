<?php

namespace App\Presenters;

use App\Transformers\OrderJpyInfoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderJpyInfoPresenter.
 *
 * @package namespace App\Presenters;
 */
class OrderJpyInfoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderJpyInfoTransformer();
    }
}
