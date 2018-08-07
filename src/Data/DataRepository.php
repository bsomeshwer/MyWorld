<?php namespace Someshwer\MyWorld\Data;

use DateTimeZone;
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
     * Path to data files
     *
     * @var string
     */
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

    /**
     * This method reads country ISO  data from a file
     *
     * @return mixed
     */
    public function countriesISOData()
    {
        $path = $this->base_path . 'country_iso.txt';
        return File::get($path);
    }

    /**
     * This method reads the continents data from a file
     *
     * @return mixed
     */
    public function continents()
    {
        $path = $path = $this->base_path . 'continents.txt';
        return File::get($path);
    }

    /**
     * Reading oceans data from a file
     *
     * @return mixed
     */
    public function oceans()
    {
        $path = $path = $this->base_path . 'oceans.txt';
        return File::get($path);
    }

    /**
     * Reading union territories data from a file
     *
     * @return mixed
     */
    public function unionTerritories()
    {
        $path = $path = $this->base_path . 'territories.txt';
        return File::get($path);
    }

    /**
     * Reading wonders data from a file
     *
     * @return mixed
     */
    public function wonders()
    {
        $path = $path = $this->base_path . 'wonders.txt';
        return File::get($path);
    }

    /**
     * Reading all timezones from predefined php library
     *
     * timezone_identifiers_list() is also returns same list of timezones.
     * It is just an alias for 'DateTimeZone::listIdentifiers(DateTimeZone::ALL)'
     *
     * @return array
     */
    public function timezones()
    {
        // timezone_identifiers_list() is also returns same list of timezones.
        return DateTimeZone::listIdentifiers(DateTimeZone::ALL);
    }

    /**
     * Reading all currencies from a text file
     *
     * @return mixed
     */
    public function currencies()
    {
        $path = $path = $this->base_path . 'currencies.txt';
        return File::get($path);
    }

    /**
     * Reading all std codes from a text file
     *
     * @return mixed
     */
    public function stdCodes()
    {
        $path = $path = $this->base_path . 'std_codes.txt';
        return File::get($path);
    }

    /**
     * Reading all states from a text file
     *
     * @return mixed
     */
    public function states()
    {
        $path = $path = $this->base_path . 'states.txt';
        return File::get($path);
    }

    /**
     * Reading all countries from countries helper for states
     *
     * @return mixed
     */
    public function countriesHelper()
    {
        $path = $path = $this->base_path . 'countries_helper.txt';
        return File::get($path);
    }

    public function cities()
    {
        $path = $path = $this->base_path . 'cities.txt';
        return File::get($path);
    }

}