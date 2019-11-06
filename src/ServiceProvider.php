<?php

namespace Lazy\Tools;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Lazy\Tools\Middleware\Decryption;

class ServiceProvider extends LaravelServiceProvider
{

    /**
     * middleware
     *
     * @var array
     */
    public $routeMiddleware = [
        'lazy-decryption' => Decryption::class,
    ];

    /**
     * 在注册后启动服务
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMiddleware();
        $this->loadResources();
    }

    /**
     * load middleware.
     */
    private function loadMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app->router->aliasMiddleware($key, $middleware);
        }
    }

    /**
     * 加载资源
     *
     * @return void
     */
    private function loadResources()
    {
        $this->publishes([
            __DIR__ . '/../config/lazy-tools.config.php' => config_path('lazy-tools.php')
        ]);
    }
}
