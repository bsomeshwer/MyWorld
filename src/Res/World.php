<?php

namespace Someshwer\MyWorld\Res;

use Someshwer\MyWorld\Data\DataRepository;

/**
 * Author: Someshwer Bandapally
 * Date: 26-05-2018
 *
 * This class is a repository contains
 * different methods to provide different
 * implementations.
 *
 * Class World
 * @package Someshwer\World\Res
 */
class World
{

    /**
     * @var DataRepository
     */
    private $data;

    /**
     * World constructor.
     * @param DataRepository $dataRepository
     */
    public function __construct(DataRepository $dataRepository)
    {
        $this->data = $dataRepository;
    }

    /**
     * Optimizing the country data
     *
     * @param $all_countries_data
     * @return string
     */
    private function optimizeCountryData($all_countries_data)
    {
        $str_length = strlen($all_countries_data) - 4;
        $all_countries_trimmed_data = substr($all_countries_data, 0, 2) . substr($all_countries_data, 3, $str_length);
        $all_countries = decrypt($all_countries_trimmed_data);
        return $all_countries;
    }

    /**
     * Get all countries
     *
     * @return array
     */
    public function countries()
    {
        $all_countries_data = $this->data->countries();
        $all_countries = $this->optimizeCountryData($all_countries_data);
        $countries = collect($all_countries)->map(function ($item) {
            // return title_case(str_replace('-',' ', $item));
            return studly_case($item);
        });
        return ['countries' => $countries];
    }

    /**
     * Search country by search string
     *
     * @param $search_string
     * @return array
     */
    public function searchCountry($search_string)
    {
        $all_countries_data = $this->data->countries();
        $all_countries = $this->optimizeCountryData($all_countries_data);
        $countries = array_map(function ($it) {
            return studly_case($it);
        }, array_filter($all_countries, function ($item) use ($search_string) {
            return strpos($item, strtolower($search_string)) === 0;
        }));
        return ['countries' => array_values($countries)];
    }

}

