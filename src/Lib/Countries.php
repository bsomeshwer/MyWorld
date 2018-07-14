<?php namespace Someshwer\MyWorld\Lib;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;

/**
 * Author: Someshwer Bandapally
 * Date: 14-07-2018
 *
 * This class gives all country names
 *
 * Class Countries
 * @package Someshwer\MyWorld\Lib
 */
class Countries extends ISOCodes
{

    /**
     * @var DataRepository
     */
    private $data;

    /**
     * @var string
     */
    private $en_key = 'Someshwer1@2#BandapallySomeshwer';

    /**
     * @var string
     */
    private $cipher = 'AES-256-CBC';

    /**
     * Countries constructor.
     * @param DataRepository $dataRepository
     */
    public function __construct(DataRepository $dataRepository)
    {
        parent::__construct($dataRepository);
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
        // $hash = new Encrypter($this->en_key, Config::get('app.cipher'));
        $hash = new Encrypter($this->en_key, $this->cipher);
        $all_countries = $hash->decrypt($all_countries_trimmed_data);
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
    public function searchCountry($search_string = null)
    {
        $all_countries_data = $this->data->countries();
        $all_countries = $this->optimizeCountryData($all_countries_data);
        if ($search_string == null) {
            return array_map(function ($it) {
                return studly_case($it);
            }, $all_countries);
        }
        $countries = array_map(function ($it) {
            return studly_case($it);
        }, array_filter($all_countries, function ($item) use ($search_string) {
            return strpos($item, strtolower($search_string)) === 0;
        }));
        return ['countries' => array_values($countries)];
    }

}