<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OrderRmbInfo;

/**
 * Class OrderRmbInfoTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderRmbInfoTransformer extends TransformerAbstract
{
    /**
     * Transform the OrderRmbInfo entity.
     *
     * @param \App\Entities\OrderRmbInfo $model
     *
     * @return array
     */
    public function transform(OrderRmbInfo $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
