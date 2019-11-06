<?php

namespace Lazy\Tools\Services;

use phpseclib\Crypt\RSA as PhpseclibRSA;

class Rsa
{
    /**
     * 加密
     *
     * @param string $data
     * @return void
     */
    public function encrypt($data = '')
    {
        $rsa = app(PhpseclibRSA::class);
        $rsa->setEncryptionMode(PhpseclibRSA::ENCRYPTION_PKCS1);
        $rsa->loadKey(file_get_contents(config('lazy-tools.rsa_public_key_path')));
        return bin2hex($rsa->encrypt($data));
    }

    /**
     * 解密
     *
     * @param string $data
     * @return void
     */
    public function decrypt($data = '')
    {
        $rsa = app(PhpseclibRSA::class);
        $rsa->setEncryptionMode(PhpseclibRSA::ENCRYPTION_PKCS1);
        $rsa->loadKey(file_get_contents(config('lazy-tools.rsa_private_key_path')));
        return $rsa->decrypt(hex2bin($data));
    }
}
