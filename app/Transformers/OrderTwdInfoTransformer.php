<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OrderTwdInfo;

/**
 * Class OrderTwdInfoTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderTwdInfoTransformer extends TransformerAbstract
{
    /**
     * Transform the OrderTwdInfo entity.
     *
     * @param \App\Entities\OrderTwdInfo $model
     *
     * @return array
     */
    public function transform(OrderTwdInfo $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
