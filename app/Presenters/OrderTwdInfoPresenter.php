<?php

namespace App\Presenters;

use App\Transformers\OrderTwdInfoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderTwdInfoPresenter.
 *
 * @package namespace App\Presenters;
 */
class OrderTwdInfoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderTwdInfoTransformer();
    }
}
