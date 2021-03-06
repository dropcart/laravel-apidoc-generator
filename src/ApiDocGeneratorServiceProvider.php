<?php

namespace Mpociot\ApiDoc;

use Illuminate\Support\ServiceProvider;
use Mpociot\ApiDoc\Commands\GenerateDocumentation;
use Mpociot\ApiDoc\Commands\RebuildDocumentation;

class ApiDocGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'apidoc');

        $this->publishes([
            __DIR__.'/../resources/views' => app()->basePath().'/resources/views/vendor/apidoc',
        ], 'apidoc-views');

        $this->publishes([
            __DIR__.'/../config/apidoc.php' => app()->basePath().'/config/apidoc.php',
        ], 'apidoc-config');

        $this->publishes([
            __DIR__.'/../config/apidoc_groups.php' => app()->basePath().'/config/apidoc_groups.php',
        ], 'apidoc-split-config');

        $this->mergeConfigFrom(__DIR__.'/../config/apidoc.php', 'apidoc');

        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateDocumentation::class,
                RebuildDocumentation::class,
            ]);
        }
    }

    /**
     * Register the API doc commands.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
