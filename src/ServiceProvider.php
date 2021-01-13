<?php

namespace Lumenx;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Lumenx\Request\RequestValidate;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * register
     *
     * @return void
     */
    public function register(): void
    {
        if (method_exists($this->app, 'configure')) {
            $this->app->configure('lumenx');
        }

        $this->mergeConfigFrom(dirname(__DIR__) . '/config/lumenx.php', 'lumenx');

        if ($this->app['config']->get('lumenx.register_make_command')) {
            $this->commands([
                \Lumenx\Console\ControllerMakeCommand::class,
                \Lumenx\Console\ModelMakeCommand::class,
                \Lumenx\Console\RequestMakeCommand::class,
                \Lumenx\Console\ResourceMakeCommand::class,
                \Lumenx\Console\EloquentFilterMakeCommand::class,
                \Lumenx\Console\ServiceMakeCommand::class,
                \Lumenx\Console\EnumMakeCommand::class,
            ]);
        }
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->bootRequestValidate();
    }

    /**
     * Bootstrap the request validate services.
     *
     * @return void
     */
    public function bootRequestValidate(): void
    {
        $this->app->afterResolving(RequestValidate::class, function ($resolved) {
            $resolved->validateResolved();
        });

        $this->app->resolving(RequestValidate::class, function ($request, $app) {
            $request = RequestValidate::createFrom($app['request'], $request);
            $request->setContainer($app);
        });
    }
}