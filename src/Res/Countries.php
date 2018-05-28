<?php namespace Someshwer\MyWorld\Res;

use Someshwer\MyWorld\Data\DataRepository;

/**
 * Author: Someshwer Bandapally
 * Date: 26-05-2018
 *
 * This class is a repository contains
 * different methods to provide different
 * implementations.
 *
 * Class Countries
 * @package Someshwer\World\Res
 */
class Countries
{

    /**
     * @var DataRepository
     */
    private $data;

    /**
     * Countries constructor.
     * @param DataRepository $dataRepository
     */
    public function __construct(DataRepository $dataRepository)
    {
        $this->data = $dataRepository;
    }

    /**
     * Get all countries
     *
     * @return array
     */
    public function all()
    {
        $all_countries = $this->data->countries();
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
        $all_countries = $this->data->countries();
        $countries = array_map(function ($it) {
            return studly_case($it);
        }, array_filter($all_countries, function ($item) use ($search_string) {
            return strpos($item, strtolower($search_string)) === 0;
        }));
        return ['countries' => array_values($countries)];
    }

}