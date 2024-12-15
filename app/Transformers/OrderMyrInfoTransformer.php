<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OrderMyrInfo;

/**
 * Class OrderMyrInfoTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderMyrInfoTransformer extends TransformerAbstract
{
    /**
     * Transform the OrderMyrInfo entity.
     *
     * @param \App\Entities\OrderMyrInfo $model
     *
     * @return array
     */
    public function transform(OrderMyrInfo $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
