<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OrderJpyInfo;

/**
 * Class OrderJpyInfoTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderJpyInfoTransformer extends TransformerAbstract
{
    /**
     * Transform the OrderJpyInfo entity.
     *
     * @param \App\Entities\OrderJpyInfo $model
     *
     * @return array
     */
    public function transform(OrderJpyInfo $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
