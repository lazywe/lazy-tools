<?php

namespace Lazy\Tools\Tests;

use Lazy\Tools\Services\Rsa;
use Lazy\Tools\Tests\TestCase;

class RsaTest extends TestCase
{

    /**
     * 公钥加密
     *
     * @return void
     */
    public function testEncrypt()
    {
        $rsa = new Rsa();
        $key = config("lazy-tools.rsa_public_key_path");
        $result = $rsa->encrypt(123, $key);
        $this->assertNotNull($result);
    }

    /**
     * 公钥加密
     *
     * @return void
     */
    public function testEncryptNoFile()
    {
        $rsa = new Rsa();
        $key = '123';
        $result = $rsa->encrypt(123, $key);
        $this->assertFalse($result);
    }

    /**
     * 公钥加密，私钥解密
     *
     * @return void
     */
    public function testDecrypt()
    {
        $rsa = new Rsa();
        $key = config("lazy-tools.rsa_public_key_path");
        $prikey = config("lazy-tools.rsa_private_key_path");
        $encryptData = $rsa->encrypt(123, $key);
        $result = $rsa->decrypt($encryptData, $prikey);
        $this->assertEquals(123, $result);
    }
}
