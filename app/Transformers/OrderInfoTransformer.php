<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OrderInfo;

/**
 * Class OrderInfoTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderInfoTransformer extends TransformerAbstract
{
    /**
     * Transform the OrderInfo entity.
     *
     * @param \App\Entities\OrderInfo $model
     *
     * @return array
     */
    public function transform(OrderInfo $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
