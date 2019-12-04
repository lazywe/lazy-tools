<?php

return [
    // 是否启用数据加密，客户端需要支持
    "cipher" => env('CIPHER', false),
    // 返回数据加密秘钥, 前16位是iv
    "aes_key" => env('AES_KEY', "84283F8F0E36BB7C4F360E068D923DFB"),
    // 客户端解密秘钥, 前16位是iv
    "client_aes_key" => env('CLIENT_AES_KEY', "A95D734B2522E2946AFEE08646CD5E75"),
    // 是否原文debug输出
    "original_debug" => env('ORIGINAL_DEBUG', false),
    // 返回数据加密的公钥
    "rsa_public_key_path" => env("RSA_PUBLIC_KEY_PATH"),
    // 私钥
    'rsa_private_key_path' => env("RSA_PRIVATE_KEY_PATH"),
];
