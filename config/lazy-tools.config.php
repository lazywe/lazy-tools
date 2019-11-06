<?php

return [
    // 是否启用数据加密，客户端需要支持
    "cipher" => env('CIPHER', false),
    // 加密解密秘钥, 前16位是iv
    "aes_key" => env('AES_KEY', "84283F8F0E36BB7C4F360E068D923DFB"),
    // 是否原文debug输出
    "original_debug" => env('ORIGINAL_DEBUG', false),
    // 系统加密的公钥
    "rsa_public_key_path" => env("RSA_PUBLIC_KEY_PATH"),
    // 客户端提供解密的私钥
    'rsa_private_key_path' => env("RSA_PRIVATE_KEY_PATH"),
];
