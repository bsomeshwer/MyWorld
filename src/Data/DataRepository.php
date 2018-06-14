<?php namespace Someshwer\MyWorld\Data;

use Illuminate\Support\Facades\File;

/**
 * Author: Someshwer Bandapally
 * Date: 25-05-2018
 *
 * This class contains all the data that need
 * to be returned up on the request.
 *
 * Class DataRepository
 * @package Someshwer\World\Data
 */
class DataRepository
{

    private $base_path = __DIR__ . '/../Res/';

    /**
     * This method contains countries data
     * such as all country names.
     *
     * @return array
     */
    public function countries()
    {
        $path = $this->base_path . 'country_names.txt';
        return File::get($path);
    }

    public function countriesISOData()
    {
        $path = $this->base_path . 'country_iso.txt';
        return File::get($path);
    }


    public function continents()
    {
        $path = $path = $this->base_path . 'continents.txt';
        return File::get($path);
    }

    public function oceans()
    {
        $path = $path = $this->base_path . 'oceans.txt';
        return File::get($path);
    }

    public function unionTerritories()
    {
        $path = $path = $this->base_path . 'territories.txt';
        return File::get($path);
    }

    public function wonders()
    {
        $path = $path = $this->base_path . 'wonders.txt';
        return File::get($path);
    }

}