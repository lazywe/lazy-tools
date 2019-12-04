<?php

namespace Lazy\Tools\Services;

class Aes
{
    /**
     * 加密
     *
     * @param string $data 加密数据
     * @param string $Key 加密key
     * @return void
     */
    public function encrypt($data = '', $key = "")
    {
        if (empty($data) || empty($key) || strlen($key) < 16) {
            return false;
        }
        $res = openssl_encrypt($data, 'aes-256-cbc', $key, 1, substr($key, 0, 16));
        return bin2hex($res);
    }

    /**
     * 解密
     *
     * @param string $data
     * @param string $key
     * @return void
     */
    public function decrypt($data = '', $key = '')
    {
        if (empty($data) || empty($key) || strlen($key) < 16) {
            return false;
        }
        $res = openssl_decrypt(hex2bin($data), 'aes-256-cbc', $key, 1, substr($key, 0, 16));
        return $res;
    }
}
