<?php

namespace Lazy\Tools\Services;

use phpseclib\Crypt\RSA as PhpseclibRSA;

class Rsa
{
    /**
     * 加密
     *
     * @param string $data
     * @param string $publicKeyPath 公钥路径
     *
     * @return void
     */
    public function encrypt($data = '', $publicKeyPath = "")
    {
        if (empty($data) || !file_exists($publicKeyPath)) {
            return false;
        }
        $rsa = new PhpseclibRSA();
        $rsa->setEncryptionMode(PhpseclibRSA::ENCRYPTION_PKCS1);
        $rsa->loadKey(file_get_contents($publicKeyPath));
        return bin2hex($rsa->encrypt($data));
    }

    /**
     * 解密
     *
     * @param string $data
     * @param string $privateKeyPath 私钥路径
     *
     * @return void
     */
    public function decrypt($data = '', $privateKeyPath = "")
    {
        if (empty($data) || !file_exists($privateKeyPath)) {
            return false;
        }
        $rsa = new PhpseclibRSA();
        $rsa->setEncryptionMode(PhpseclibRSA::ENCRYPTION_PKCS1);
        $rsa->loadKey(file_get_contents($privateKeyPath));
        return $rsa->decrypt(hex2bin($data));
    }
}
