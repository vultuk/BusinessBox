<?php

namespace Vultuk\BusinessBox\Products;

use Vultuk\BusinessBox\Contracts\Product as ProductContract;
use Vultuk\BusinessBox\Product;

class Pension extends Product implements ProductContract
{

    public $key = 'pension';

    protected $fields = [
        'would_you_like_a_review' => 'type:bool',
        'is_civil_service' => 'type:bool',
        'is_sipp_or_sass_liquid' => 'type:bool',
        'is_sipp_or_sass_non_liquid' => 'type:bool',
        'is_private_or_frozen_occupational' => 'type:bool',
        'is_pension_occupation_scheme' => 'type:bool',
        'is_submitted_pension_protection_fund' => 'type:bool',
        'is_currently_consulting_ifa' => 'type:bool',
        'is_currently_having_review' => 'type:bool',
        'has_had_review_last_12_months' => 'type:bool',
        'is_from_stjames_or_hargreaves' => 'type:bool',
        'is_currently_drawing_down' => 'type:bool',
        'estimated_pension_value' => 'type:integer',
        'estimated_retirement_age' => 'type:integer',
        'provider_name' => 'type:string',
        'policy_number' => 'type:string',
        'scheme_name' => 'type:string',
        'pension_type' => 'type:string',
        'member_number' => 'type:string',
        'administrator_address' => 'type:string',
    ];

}
