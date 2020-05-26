<?php namespace Someshwer\MyWorld\Lib;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;

/**
 * Author: Someshwer Bandapally
 * Date: 25-05-2018
 *
 * This class gives all currency names
 *
 * Class Currencies
 * @package Someshwer\MyWorld\Lib
 */
class Currencies extends StdCodes
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

    public function __construct(DataRepository $dataRepository)
    {
        parent::__construct($dataRepository);
        $this->data = $dataRepository;
    }

    /**
     * Optimizes currency data
     *
     * @param $all_currencies_data
     * @return string
     */
    private function optimizeCurrenciesData($all_currencies_data)
    {
        $str_length = strlen($all_currencies_data) - 4;
        $all_currencies_trimmed_data = substr($all_currencies_data, 0, 2) . substr($all_currencies_data, 3, $str_length);
        $hash = new Encrypter($this->en_key, $this->cipher);
        return $hash->decrypt($all_currencies_trimmed_data);
    }

    /**
     * Getting optimized currency data
     *
     * @return mixed|string
     */
    private function getOptimizedCurrenciesData()
    {
        $all_currencies_data = $this->data->currencies();
        $currencies_data = $this->optimizeCurrenciesData($all_currencies_data);
        $currencies_data = json_decode($currencies_data, true);
        return $currencies_data;
    }

    /**
     * All currencies data
     *
     * @return mixed|string
     */
    public function currencies()
    {
        return $this->getOptimizedCurrenciesData();
    }

    /**
     * Search currency by either currency name or country name
     *
     * @param $search_key
     * @return static
     */
    public function searchCurrency($search_key = null)
    {
        if (!$search_key) {
            return [];
        }
        return collect($this->getOptimizedCurrenciesData())->filter(function($item) use ($search_key) {
            return ((strpos(strtolower($item['currency_name']), strtolower($search_key)) !== false) ||
                (strpos(strtolower($item['country_name']), strtolower($search_key)) !== false));
        })->values();
    }

    /**
     * Get currency by country name
     *
     * @param $country_name
     * @return static
     */
    public function currencyByCountryName($country_name = null)
    {
        if (!$country_name) {
            return [];
        }
        return collect($this->getOptimizedCurrenciesData())->filter(function($item) use ($country_name) {
            return (strtolower($item['country_name']) == strtolower($country_name));
        })->values();
    }

    /**
     * Get currency b y country code
     *
     * @param $country_code
     * @return static
     */
    public function currencyByCountryCode($country_code = null)
    {
        if (!$country_code) {
            return [];
        }
        return collect($this->getOptimizedCurrenciesData())->filter(function($item) use ($country_code) {
            return (strtolower($item['country_code']) == strtolower($country_code));
        })->values();
    }

    /**
     * Get currency by currency name
     *
     * @param $currency_name
     * @return static
     */
    public function currencyByCurrencyName($currency_name = null)
    {
        if (!$currency_name) {
            return [];
        }
        return collect($this->getOptimizedCurrenciesData())->filter(function($item) use ($currency_name) {
            return (strpos(strtolower($item['currency_name']), strtolower($currency_name)) !== false);
        })->values();
    }

    /**
     * Get currency by currency code
     *
     * @param $currency_code
     * @return static
     */
    public function currencyByCurrencyCode($currency_code = null)
    {
        if (!$currency_code) {
            return [];
        }
        return collect($this->getOptimizedCurrenciesData())->filter(function($item) use ($currency_code) {
            return (strtolower($item['currency_code']) == strtolower($currency_code));
        })->values();
    }


}