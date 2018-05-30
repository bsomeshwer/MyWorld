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

    /**
     * This method contains countries data
     * such as all country names.
     *
     * @return array
     */
    public function countries()
    {
        $path = __DIR__ . '/../Res/country_names.txt';
        $data = File::get($path);
        return $data;
    }

    public function countriesISOData()
    {
        $path = __DIR__ . '/../Res/country_iso.txt';
        $data = File::get($path);
        return $data;
    }

}