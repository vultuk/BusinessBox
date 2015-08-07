<?php namespace Vultuk\BusinessBox\Contracts;

interface Encrypt
{

    public static function encrypt($data, $publicKey, $secretKey, $apiVersion = 1);

    public function encryptData($data);

}