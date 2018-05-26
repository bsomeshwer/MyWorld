<?php namespace Someshwer\World;

use Illuminate\Support\ServiceProvider;
use Someshwer\World\Data\DataRepository;
use Someshwer\World\Res\Countries;

/**
 * Created by PhpStorm.
 * User: babi
 * Date: 26/5/18
 * Time: 11:17 AM
 */
class WorldDataServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('someshwer-countries', function(){
            return new Countries(new DataRepository());
        });
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
    }


}