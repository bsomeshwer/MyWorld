<?php namespace Someshwer\MyWorld\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Author: Someshwer Bandapally
 * Date: 25-05-2018
 *
 * This is a facade class to make World class as a facade
 *
 * Class World
 * @package Someshwer\World\Facades
 */
class World extends Facade
{
    /**
     * Static method facade accessor
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'bs-world';
    }

}