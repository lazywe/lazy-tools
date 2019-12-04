<?php

use Lazy\Tools\Services\Rsa;
use Lazy\Tools\Services\Aes;

/**
 * Json返回
 *
 * @param string $status 状态码   200成功 500失败
 * @param string $msg    返回信息
 * @param array  $data   附加内容
 *
 * @return void
 */
function json($status = 200, $msg = "", $data = [])
{
    $responseData = [
        'status' => $status,
        'msg'    => $msg,
        'data'   => $data
    ];
    // 未开启加密
    if (config('lazy-tools.cipher') === false) {
        return response()->json($responseData);
    }
    // 开启了加密
    $d = app(Rsa::class)->encrypt(
        config('lazy-tools.aes_key'),
        config('lazy-tools.rsa_public_key_path')
    );
    $e = app(Aes::class)->encrypt(
        json_encode($responseData),
        config('lazy-tools.aes_key')
    );
    $res = [
        'd' => $d,
        'e' => $e
    ];
    // 输出明文
    if (request()->input('tnt') == date("Ymd") || config('lazy-tools.original_debug')) {
        $res['f'] = $responseData;
    }
    return response()->json($res);
}
