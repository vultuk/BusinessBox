<?php

namespace Vultuk\BusinessBox;

use Vultuk\BusinessBox\Contracts\Client as ClientContract;
use Vultuk\BusinessBox\Extensions\Arrayable;
use Vultuk\BusinessBox\Extensions\MagicSetter;
use Vultuk\BusinessBox\Extensions\Validation;

class Client implements ClientContract
{
    use Arrayable, MagicSetter, Validation;

    protected $fields = [
        'title',
        'first_name' => 'required',
        'surname' => 'required',
        'dob',
        'ni_number',
        'house_number' => 'required',
        'address',
        'post_code' => 'required|type:postcode',
        'client_password',
        'telephone_no' => 'required|type:telephone',
        'mobile_no' => 'type:telephone',
        'work_no' => 'type:telephone',
        'other_no' => 'type:telephone',
        'email' => 'type:email',
        'marital_status',
        'spouse_dob',
        'employment_status',
        'occupation',
        'next_of_kin',
        'next_of_kin_relation',
    ];

    public function combineAddress(...$lines)
    {
        return implode(', ', $lines);
    }

    public static function create(array $allDetails)
    {
        $product = new static();

        $product->arrayData = $allDetails;

        return $product;
    }

}
