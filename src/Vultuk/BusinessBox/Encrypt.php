<?php

namespace Vultuk\BusinessBox;

use Vultuk\BusinessBox\Contracts\Encrypt as EncryptContract;

class Encrypt implements EncryptContract
{

    protected $apiVersion = 1;

    protected $publicKey = '';

    protected $secretKey = '';

    protected $data = null;

    public static function encrypt()
    {


        $ciphertext = encrypt_aes128($secret_key, $data, false);
        $signature = hmac_sha256($secret_key, $ciphertext, false);
        return $this->apiVersion."/".$this->publicKey."\n".$ciphertext."\n".$signature."\n";
    }

    protected function encode($secret_key, $method, $keysize_bits, $data, $raw_output = false)
    {
        $key = substr($secret_key, 0, $keysize_bits/8);

        $iv_size = mcrypt_get_iv_size($method, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);

        $ciphertext = $iv.mcrypt_encrypt($method, $key, $data, MCRYPT_MODE_CBC, $iv);

        if (!$raw_output) { return base64_encode($ciphertext); }

        return $ciphertext;
    }

    protected function encryptAes($bits)
    {
        return $this->encode()
    }

    protected function encrypt_aes192($secret_key, $data, $raw_output=false)
    {
        return $this->encode($secret_key, MCRYPT_RIJNDAEL_192, 24*8, $data, $raw_output);
    }

    protected function encrypt_aes128($secret_key, $data, $raw_output=false)
    {
        return $this->encode($secret_key, MCRYPT_RIJNDAEL_128, 16*8, $data, $raw_output);
    }

    protected function hmac_sha256($secret_key, $data, $raw_output=false)
    {
        return $this->hmac($secret_key, 'sha256', 512, $data, $raw_output);
    }
    
    protected function hmac($secret_key, $hashfunc, $blocksize, $data, $raw_output=false)
    {
        $key  = $this->hexToBinary($secret_key);

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

        return hash($hashfunc, $o_key_pad.hash($hashfunc, $i_key_pad.$data, true), $raw_output);
    }

    protected function hexToBinary($string)
    {
        return pack('H*', $string);
    }

    public function __construct($data = null)
    {
        $this->data = $data;
    }

}
