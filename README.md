# lazy-tools

- 基于laravel的工具脚手架，支持数据Rsa Aes双重加密
- 常用函数
- 密文模式
- [![travis](https://api.travis-ci.com/lazywe/lazy-tools.svg?token=8wKKpjrd41uzSUZMSZoy&branch=master)](https://travis-ci.com/lazywe/lazy-tools)

# Requirement
- php >= 5.3
- Composer
- phpseclib/phpseclib

# Installation

## first

- composer.json 中新增如下

```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/lazywe/lazy-tools"
        }
    ],
```

```json
    composer require lazywe/lazy-tools -vvv
```


## Second

- 加载配置

```json
    php artisan vendor:publish --provider='Lazy\Tools\ServiceProvider'
```

## Third

# 基础函数

```php
json(Code $status, string $msg, array $data);
```



# 密文模式

- 密文模式解密需要全局中间件 “lazy-decryption”
- 密文模式需要 env中新增如下
```ini

    CIPHER=true #是否启用数据加密，客户端需要支持, 默认关闭

    AES_KEY=84283F8F0E36BB7C4F360E068D923DFB #32位你的秘钥

    ORIGINAL_DEBUG=false #是否需要显示原文

    RSA_PUBLIC_KEY_PATH=public.key #系统加密的公钥 storage目录下

    RSA_PRIVATE_KEY_PATH=private.key #客户端提供解密的私钥 storage目录下
```

#### 请求

- 接收的 **请求参数** 有两个 一个是 “d” 一个是 “e”, 分别都是加密的16进制的数据
- "d" 是rsa加密的部分
- "e" 是aes加密的部分

#### 返回

- **返回参数** 有三个
- 一个是 “d” 一个是 “e”, 一个是 “f”
- “d”和“e”分别都是加密的16进制的数据
- “f”需要 ORIGINAL_DEBUG=true 的时候才能输出，调试的时候使用
- "d" 是rsa加密的部分
- "e" 是aes加密的部分

#### 栗子


```js
    // Usage 前端部分，拿JavaScript为例，
    var params = {
        "username":"lazy",
        "password":"123456",
    };
    var data = {
        d:"rsa加密后得16进制的数据",
        e:"aes使用rsa加密的秘钥将{params}加密后的16进制的数据"
    }
    $.ajax({
        "url":"test",
        "type":"post",
        "timeout":3,
        data:data,
        success:(e){
            console.log(e);
            var key = "rsa解密 e.data.d";
            var params = "aes解密 e.data.e 秘钥是key";
            console.log(params.username)
            console.log(params.password)
             // 输出如下
             // lazy
             // 123456
        }
    })

```

- 前端加密解密 js 版本  <font color=#FF0000>待定</font>
- 前端加密解密 dart 版本 <font color=#FF0000>待定</font>

```php
<?php
    // Usage 加载middleware lazy-decryption, 即可解出params
    Route::get("test", "TestController@index")->middleware(['lazy-decryption'])

?>

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\EventDispatcher\Event;
use Lazy\Tools\Code;

class TestController extends Controller
{

    /**
     * index
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        // echo $username;
        // echo "<br/>";
        // echo $password;
        // exit;
        // 输出如下
        // lazy
        // 123456
        $data = [
            'username' => $username,
            'password' => $password,
        ]
        return json(Code::success, 'success', $data);
    }
}
?>

```