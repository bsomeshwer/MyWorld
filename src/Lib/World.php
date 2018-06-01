<?php

namespace Someshwer\MyWorld\Lib;

use Illuminate\Encryption\Encrypter;
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
     * @var string
     */
    private $en_key = 'Someshwer1@2#BandapallySomeshwer';

    /**
     * @var string
     */
    private $cipher = 'AES-256-CBC';

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
        // $hash = new Encrypter($this->en_key, Config::get('app.cipher'));
        $hash = new Encrypter($this->en_key, $this->cipher);
        $all_countries = $hash->decrypt($all_countries_trimmed_data);
        return $all_countries;
    }

    public function optimizeISOData($all_iso_data)
    {
        $str_length = strlen($all_iso_data) - 4;
        $all_iso_trimmed_data = substr($all_iso_data, 0, 2) . substr($all_iso_data, 3, $str_length);
        // $hash = new Encrypter($this->en_key, Config::get('app.cipher'));
        $hash = new Encrypter($this->en_key, $this->cipher);
        $all_iso = $hash->decrypt($all_iso_trimmed_data);
        return $all_iso;
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

    private function getOptimizedIsoData()
    {
        $all_countries_iso_data = $this->data->countriesISOData();
        $iso_data = $this->optimizeISOData($all_countries_iso_data);
        return $iso_codes = json_decode($iso_data, true);
    }

    public function isoCodes()
    {
        return $this->getOptimizedIsoData();
    }

    private function isoErrorResponse($param = null)
    {
        $status = 'INVALID_CODE';
        $message = 'Invalid ISO code!';
        if ($param == 'NO_PARAM') {
            $status = 'CODE_REQUIRED';
            $message = 'ISO code parameter is required';
        }
        return response(['error' => true, 'status' => $status, 'message' => $message], 422);
    }

    private function optimizeIsoResult($iso_codes, $alpha_code)
    {
        $group_by = ctype_digit($alpha_code) ? 'country_numeric_code' : ((strlen($alpha_code) == 2) ? 'alpha_2' : 'alpha_3');
        $alpha_code = ctype_digit($alpha_code) ? (int)$alpha_code : strtoupper($alpha_code);
        $result = collect($iso_codes)->groupBy($group_by)->get($alpha_code);
        if ($result == null) {
            return $this->isoErrorResponse();
        } else {
            return response(['success' => true, 'iso_info' => $result->first()], 200);
        }
    }

    public function searchIsoCodes($key)
    {

    }

    public function filterIsoInfoByCountryName($iso_codes, $name)
    {
        return collect($iso_codes)->map(function ($item, $key) {
            $item['display_name'] = $item['name'];
            $item['name'] = strtolower(studly_case($item['name']));
            return $item;
        })->groupBy('name')->filter(function ($item, $key) use ($name) {
            return strpos($key, $name) === 0;
        })->collapse();
    }

    public function isoInfoByCountryName($name = null)
    {
        if ($name == null) return [];
        $iso_codes = $this->getOptimizedIsoData();
        $result = $this->filterIsoInfoByCountryName($iso_codes, $name);
        if ($result == null) return [];
        return $result;
    }

    public function isoInfoByCode($code = null)
    {
        if ($code == null) {
            return $this->isoErrorResponse('NO_PARAM');
        }
        $iso_codes = $this->getOptimizedIsoData();
        return $this->optimizeIsoResult($iso_codes, $code);
    }

    private function formatRegions($iso_codes)
    {
        $regions = collect($iso_codes)->groupBy('region')->all();
        $new_regions = [];
        foreach ($regions as $key => $region) {
            if ($key == '') {
                $key = $region[0]['name'];
            }
            $new_regions[$key] = $region;
        }
        return $new_regions;
    }

    private function filterRegions($regions, $region)
    {
        return collect($regions)->filter(function ($item, $key) use ($region) {
            return ($region == null) ? true : (strpos(strtolower($key), strtolower($region)) === 0) ? true : false;
        });
    }

    public function isoCodesByRegion($region = null)
    {
        $iso_codes = $this->getOptimizedIsoData();
        $regions = $this->formatRegions($iso_codes);
        return $this->filterRegions($regions, $region);
    }


}

