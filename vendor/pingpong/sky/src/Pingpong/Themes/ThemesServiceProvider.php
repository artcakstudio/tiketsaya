<?php

namespace Pingpong\Themes;

use Illuminate\Support\ServiceProvider;

class ThemesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->registerConfig();

        $this->registerNamespaces();

        $this->registerHelpers();
    }

    /**
     * Register the helpers file.
     */
    public function registerHelpers()
    {
        require __DIR__.'/helpers.php';
    }

    /**
     * Register configuration file.
     */
    protected function registerConfig()
    {
        $configPath = __DIR__.'/src/config/config.php';

        $this->publishes([$configPath => config_path('themes.php')]);

        $this->mergeConfigFrom($configPath, 'themes.php');
    }

    /**
     * Register the themes namespaces.
     */
    protected function registerNamespaces()
    {
        $this->app['themes']->registerNamespaces();
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app['themes'] = $this->app->share(function ($app) {
            return new Repository(
                new Finder(),
                $app['config'],
                $app['view'],
                $app['translator'],
                $app['cache.store']
            );
        });

        $this->registerCommands();
    }

    /**
     * Register commands.
     */
    protected function registerCommands()
    {
        $this->commands('Pingpong\Themes\Console\MakeCommand');
        $this->commands('Pingpong\Themes\Console\CacheCommand');
        $this->commands('Pingpong\Themes\Console\ListCommand');
        $this->commands('Pingpong\Themes\Console\PublishCommand');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('themes');
    }
}
