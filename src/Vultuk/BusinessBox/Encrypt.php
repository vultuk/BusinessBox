<?php

namespace Vultuk\BusinessBox;

// Initial code for the encryption provided by
// Ben Golightly <golightly.ben@googlemail.com>

use Vultuk\BusinessBox\Contracts\Encrypt as EncryptContract;

/**
 * Class used to encrypt client data when sent to the API
 *
 * Class Encrypt
 * @package Vultuk\BusinessBox
 */
class Encrypt implements EncryptContract
{

    /**
     * The version of the API we are sending to
     *
     * @var int
     */
    protected $apiVersion;

    /**
     * Public key that is being used
     *
     * @var
     */
    protected $publicKey;

    /**
     * Secret key that is being used
     *
     * @var
     */
    protected $secretKey;

    /**
     * Holds the data that is being encrypted
     *
     * @var
     */
    protected $data;

    /**
     * Method to be called statically to encrypt in one easy call
     *
     * @param $data
     * @param $publicKey
     * @param $secretKey
     * @param int $apiVersion
     * @return string
     */
    public static function encrypt($data, $publicKey, $secretKey, $apiVersion = 1)
    {
        $encrypt = new self($data, $publicKey, $secretKey, $apiVersion);

        return $encrypt->encryptData($data);
    }

    /**
     * Sets the procedure to encrypt the data
     *
     * @param $data
     * @return string
     * @throws \Exception
     */
    public function encryptData($data)
    {
        $this->data = $data;

        $cipherText = $this->encodeData(128, $this->data);
        $signature = $this->encodeHmac(512, $cipherText);

        return $this->apiVersion."/".$this->publicKey."\n".$cipherText."\n".$signature."\n";
    }

    /**
     * Encodes data to a given bit size
     *
     * @param $bitSize
     * @param $data
     * @param bool|false $raw_output
     * @return string
     */
    protected function encodeData($bitSize, $data, $raw_output = false)
    {
        $method = ($bitSize == 192) ? MCRYPT_RIJNDAEL_192 : MCRYPT_RIJNDAEL_128;
        $key = substr($this->secretKey, 0, $bitSize/8);

        $iv = mcrypt_create_iv(
            mcrypt_get_iv_size(
                $method,
                MCRYPT_MODE_CBC
            ),
            MCRYPT_DEV_URANDOM
        );

        $data = $iv.mcrypt_encrypt(
            $method,
            $key,
            $data,
            MCRYPT_MODE_CBC,
            $iv
        );

        if (!$raw_output)
        {
            $data = base64_encode($data);
        }

        return $data;
    }

    /**
     * Encodes data using a hmac created with the given block size
     *
     * @param $blocksize
     * @param $data
     * @param bool|false $raw_output
     * @return string
     * @throws \Exception
     */
    protected function encodeHmac($blocksize, $data, $raw_output=false)
    {
        $key  = $this->hexToBinary($this->secretKey);

        if (strlen($key) != ($blocksize/8)) { throw new \Exception('invalid secret key block size'); }

        // constants specified by rfc2104
        $opad = 0x5c;
        $ipad = 0x36;

        $o_key_pad = $i_key_pad = '';

        for($i = 0; $i < $blocksize; $i++)
        {
            $o_key_pad .= chr(ord(substr($key,$i,1)) ^ $opad);
            $i_key_pad .= chr(ord(substr($key,$i,1)) ^ $ipad);
        }

        return hash('sha256', $o_key_pad.hash('sha256', $i_key_pad.$data, true), $raw_output);
    }

    /**
     * Allows us to universally convert hex to binary if hex2bin method is
     * not available
     *
     * @param $string
     * @return string
     */
    protected function hexToBinary($string)
    {
        return pack('H*', $string);
    }

    /**
     * Constructor to create the Encryption object
     *
     * @param $publicKey
     * @param $secretKey
     * @param int $apiVersion
     */
    public function __construct($publicKey, $secretKey, $apiVersion = 1)
    {
        $this->publicKey = $publicKey;
        $this->secretKey = $secretKey;
        $this->apiVersion = $apiVersion;
    }

}
