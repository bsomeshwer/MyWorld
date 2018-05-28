<?php namespace Someshwer\MyWorld;

use Illuminate\Support\ServiceProvider;
use Someshwer\MyWorld\Data\DataRepository;
use Someshwer\MyWorld\Res\Countries;

/**
 * Author: Someshwer Bandapally
 * Date: 26-05-2018
 *
 * Class WorldDataServiceProvider
 * @package Someshwer\World
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