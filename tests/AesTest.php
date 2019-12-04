<?php

namespace Lazy\Tools\Tests;

use Lazy\Tools\Services\Aes;
use Lazy\Tools\Tests\TestCase;

class AesTest extends TestCase
{
    /**
     * 测试的加密
     *
     * @return void
     */
    public function testEncryptNotEmpty()
    {
        $key = config('lazy-tools.aes_key');
        $aes = new Aes();
        $result = $aes->encrypt(123, $key);
        $this->assertNotNull($result);
    }

    /**
     * 测试的加密
     *
     * @return void
     */
    public function testNncryptNotKey()
    {
        $aes = new Aes();
        $result = $aes->encrypt(123);
        $this->assertFalse($result);
    }

    /**
     * 测试的解密
     *
     * @return void
     */
    public function testDecrypt()
    {
        $key = config('lazy-tools.aes_key');
        $aes = new Aes();
        $encryptData = $aes->encrypt(123, $key);
        $result = $aes->decrypt($encryptData, $key);
        $this->assertEquals($result, 123);
    }

    /**
     * 测试的解密
     *
     * @return void
     */
    public function testDecryptNotKey()
    {
        $key = 123313123123123313123123123313123123123313123123123313123123123313123123123313123123123313123123;
        $aes = new Aes();
        $encryptData = $aes->encrypt(123, $key);
        $result = $aes->decrypt($encryptData, $key);
        $this->assertEquals($result, 123);
    }

    /**
     * 测试的解密,秘钥中截取16个iv，当key<16没意义
     *
     * @return void
     */
    public function testEncryptNot16()
    {
        $key = 1233131231;
        $aes = new Aes();
        $encryptData = $aes->encrypt(123, $key);
        $this->assertFalse($encryptData);
    }
}
