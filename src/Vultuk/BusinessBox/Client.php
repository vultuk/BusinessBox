<?php

namespace Vultuk\BusinessBox;

use Vultuk\BusinessBox\Contracts\Client as ClientContract;
use Vultuk\BusinessBox\Extensions\Arrayable;
use Vultuk\BusinessBox\Extensions\MagicSetter;
use Vultuk\BusinessBox\Extensions\Validation;

/**
 * Class Client
 * @package Vultuk\BusinessBox
 */
class Client implements ClientContract
{
    use Arrayable, MagicSetter, Validation;

    /**
     * Stores all the fields that can be sent for a client where key is the
     * property used in the API and the value is a | separated list of strings
     * showing if fields are required and the respective type
     *
     * @var array
     */
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

    /**
     * Combines multiple lines of an address into a comma separated single line
     *
     * @param ...$lines
     * @return string
     */
    public static function combineAddress(...$lines)
    {
        $fullAddress = [];

        foreach ($lines as $line)
        {
            if (!empty($line) && strlen($line) > 1)
            {
                $fullAddress[] = $line;
            }
        }

        return implode(', ', $fullAddress);
    }

    /**
     * Creates a client from all the details given in an array
     *
     * @param array $allDetails
     * @return static
     */
    public static function create(array $allDetails)
    {
        $product = new static();

        $product->arrayData = $allDetails;

        return $product;
    }

}
