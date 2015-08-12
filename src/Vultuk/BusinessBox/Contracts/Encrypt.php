<?php namespace Vultuk\BusinessBox\Contracts;

/**
 * Interface to be used in Encryption classes to ensure required
 * functionality is available
 *
 * Interface Encrypt
 * @package Vultuk\BusinessBox\Contracts
 */
interface Encrypt
{
    /**
     * Method to be called statically to encrypt in one easy call
     *
     * @param $data
     * @param $publicKey
     * @param $secretKey
     * @param int $apiVersion
     * @return string
     */
    public static function encrypt($data, $publicKey, $secretKey, $apiVersion = 1);

    /**
     * Sets the procedure to encrypt the data
     *
     * @param $data
     * @return string
     * @throws \Exception
     */
    public function encryptData($data);

}