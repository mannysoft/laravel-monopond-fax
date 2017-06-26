<?php 

namespace FaxBroadcast\LaravelMonopondFax;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use MonopondSOAPClientV2_1;
use MonopondClasses\MPENV;

class ServiceProvider extends BaseServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/monopond.php' => config_path('monopond.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/monopond.php', 'monopond'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('monopond-fax',function(){
            $environment = config('monopond.environment');
            return new MonopondSOAPClientV2_1(config('monopond.username'), config('monopond.password'), constant("MPENV::{$environment}"));
        });
    }

}