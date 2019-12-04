<?php

namespace Lazy\Tools\Middleware;

use Closure;
use Lazy\Tools\Code;
use Lazy\Tools\Services\Aes;
use Lazy\Tools\Services\Rsa;

class Decryption
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 未开启数据加密
        if (config('lazy-tools.cipher') === false) {
            return $next($request);
        }
        // 开起了数据加密
        $e = $request->input('e');
        if (empty($d) || empty($e)) {
            return json(Code::ERROR, 'request fail');
        }
        $result = app(Aes::class)->decrypt(
            $e,
            config('lazy-tools.client_aes_key')
        );
        // 解密失败
        if (!$result) {
            return json(Code::ERROR, 'request fail');
        }
        $arr = json_decode($result, true);
        // 将解密的数据设置成request params 兼容已有程序
        if (!empty($arr)) {
            foreach ($arr as $k => $v) {
                $request->offsetSet($k, $v);
            }
        }

        return $next($request);
    }
}
