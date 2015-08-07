<?php

namespace Vultuk\BusinessBox;

use Vultuk\BusinessBox\Contracts\Encrypt as EncryptContract;

class Encrypt implements EncryptContract
{

    protected $apiVersion;

    protected $publicKey;

    protected $secretKey;

    protected $data;

    public static function encrypt($data, $publicKey, $secretKey, $apiVersion = 1)
    {
        $encrypt = new self($data, $publicKey, $secretKey, $apiVersion);

        return $encrypt->encryptData($data);
    }

    public function encryptData($data)
    {
        $this->data = $data;

        $cipherText = $this->encodeData(128, $this->data);
        $signature = $this->encodeHmac(512, $cipherText);

        return $this->apiVersion."/".$this->publicKey."\n".$cipherText."\n".$signature."\n";
    }

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

    protected function hexToBinary($string)
    {
        return pack('H*', $string);
    }

    public function __construct($publicKey, $secretKey, $apiVersion = 1)
    {
        $this->publicKey = $publicKey;
        $this->secretKey = $secretKey;
        $this->apiVersion = $apiVersion;
    }

}
