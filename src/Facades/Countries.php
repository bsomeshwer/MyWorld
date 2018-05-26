<?php namespace Someshwer\World\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * Created by PhpStorm.
 * User: babi
 * Date: 26/5/18
 * Time: 12:07 PM
 */
class Countries extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'someshwer-countries';
    }

}