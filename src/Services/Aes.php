<?php

namespace Lazy\Tools\Services;

class Aes
{
    /**
     * 加密
     *
     * @param string $data
     * @return void
     */
    public function encrypt($data = '')
    {
        $key = config('lazy-tools.aes_key');
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
        $res = openssl_decrypt(hex2bin($data), 'aes-256-cbc', $key, 1, substr($key, 0, 16));
        return $res;
    }
}
