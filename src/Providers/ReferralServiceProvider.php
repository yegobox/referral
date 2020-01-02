<?php
namespace Yegobox\Referral\Providers;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Yegobox\Referral\Http\Middleware\Locale;
use Yegobox\Referral\Observers\ReferralModelObserver;

class ReferralServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router){
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'referral');

        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('themes/default/assets'),
        ], 'public');

        $this->registerPublishing();
        
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'referral');

        $router->aliasMiddleware('locale', Locale::class);

        if(config()->has('referral.model')){
            $model = config('referral.model');
            $model::observe(ReferralModelObserver::class);
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
           
            $this->publishes([
                dirname(__DIR__) . '/Config/referral.php' => config_path('referral.php'),
            ], 'referral-config');
        }
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/referral.php', 'refferal.stomer'
        );
    }
}
