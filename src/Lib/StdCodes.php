<?php

namespace Someshwer\MyWorld\Lib;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;

/**
 * Author: Someshwer Bandapally
 * Date: 18-07-2018.
 *
 * This class provides STD codes data
 *
 * Class StdCodes
 */
class StdCodes extends States
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
     * StdCodes constructor.
     *
     * @param DataRepository $dataRepository
     */
    public function __construct(DataRepository $dataRepository)
    {
        parent::__construct($dataRepository);
        $this->data = $dataRepository;
    }

    /**
     * Optimize STD codes data.
     *
     * @param $all_std_codes_data
     *
     * @return string
     */
    private function optimizeStdCodesData($all_std_codes_data)
    {
        $str_length = strlen($all_std_codes_data) - 4;
        $all_std_codes_trimmed_data = substr($all_std_codes_data, 0, 2).substr($all_std_codes_data, 3, $str_length);
        $hash = new Encrypter($this->en_key, $this->cipher);

        return $hash->decrypt($all_std_codes_trimmed_data);
    }

    /**
     * Fetch optimized std codes data.
     *
     * @return string
     */
    private function getOptimizedStdCodesData()
    {
        $all_std_codes__data = $this->data->stdCodes();
        $std_codes_data = $this->optimizeStdCodesData($all_std_codes__data);
        // $std_codes_data = json_decode($std_codes_data, true);
        return $std_codes_data;
    }

    /**
     * Returns all std codes.
     *
     * @return string
     */
    public function stdCodes()
    {
        return $this->getOptimizedStdCodesData();
    }

    /**
     * Search STD codes.
     *
     * @param null $search_string
     *
     * @return array|static
     */
    public function searchStdCodes($search_string = null)
    {
        if (is_null($search_string)) {
            return [];
        }
        $std_codes = $this->getOptimizedStdCodesData();

        return collect($std_codes)->filter(function ($item) use ($search_string) {
            return (substr(strtolower($item['country_name']), 0, strlen($search_string)) == strtolower($search_string)) ||
                (strtolower($item['country_code']) == strtolower($search_string)) ||
                (strpos(strtolower($item['std_code']), strtolower($search_string)) !== false);
        })->transform(function ($value) {
            return array_except($value, 'id');
        })->values();
    }

    /**
     * Search STD code by country name.
     *
     * @param null $country_name
     *
     * @return array|static
     */
    public function stdCodeByCountryName($country_name = null)
    {
        if (is_null($country_name)) {
            return [];
        }
        $std_codes = $this->getOptimizedStdCodesData();

        return collect($std_codes)->filter(function ($item) use ($country_name) {
            return substr(strtolower($item['country_name']), 0, strlen($country_name)) == strtolower($country_name);
        })->transform(function ($value) {
            return array_except($value, 'id');
        })->values();
    }

    /**
     * Search STD code by country code.
     *
     * @param null $country_code
     *
     * @return array|static
     */
    public function stdCodeByCountryCode($country_code = null)
    {
        if (is_null($country_code)) {
            return [];
        }
        $std_codes = $this->getOptimizedStdCodesData();

        return collect($std_codes)->filter(function ($item) use ($country_code) {
            return strtolower($item['country_code']) == strtolower($country_code);
        })->transform(function ($value) {
            return array_except($value, 'id');
        })->values();
    }
}
