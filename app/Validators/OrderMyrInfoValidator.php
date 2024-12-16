<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\MessageBag;

/**
 * Class OrderMyrInfoValidator.
 *
 * @package namespace App\Validators;
 */
class OrderMyrInfoValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'show_order_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|json',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'currency' => 'required|in:TWD,USD,JPY,RMB,MYR',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'show_order_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|json',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'currency' => 'required|in:TWD,USD,JPY,RMB,MYR',
        ],
    ];

    /**
     * Custom Validator to check if address contains city.
     */
    public function validateAddressDetail($attribute, $value, $parameters, $validator)
    {
        $address = json_decode($value, true);

        if (!isset($address['city']) || empty(trim($address['city']))) {
            throw new ValidatorException((new MessageBag())->add('address', 'city is required.'));
        } else if (!isset($address['district']) || empty(trim($address['district']))) {
            throw new ValidatorException((new MessageBag())->add('address', 'district is required.'));
        } else if (!isset($address['street']) || empty(trim($address['street']))) {
            throw new ValidatorException((new MessageBag())->add('address', 'street is required.'));
        }
    }
}
