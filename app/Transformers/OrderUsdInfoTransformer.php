<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OrderUsdInfo;

/**
 * Class OrderUsdInfoTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderUsdInfoTransformer extends TransformerAbstract
{
    /**
     * Transform the OrderUsdInfo entity.
     *
     * @param \App\Entities\OrderUsdInfo $model
     *
     * @return array
     */
    public function transform(OrderUsdInfo $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
