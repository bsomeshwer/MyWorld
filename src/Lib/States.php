<?php namespace Someshwer\MyWorld\Lib;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;
use Someshwer\MyWorld\Helpers\MyPaginate;

/**
 * Author: Someshwer Bandapally
 * Date: 24-07-2018
 *
 * This class provides States data like all state names
 *
 * Class StdCodes
 * @package Someshwer\MyWorld\Lib
 */
class States extends Cities
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
     * States constructor.
     * @param DataRepository $dataRepository
     */
    public function __construct(DataRepository $dataRepository)
    {
        parent::__construct($dataRepository);
        $this->data = $dataRepository;
    }

    /**
     * Optimize all countries data
     *
     * @param $all_countries_data
     * @return string
     */
    private function optimizeCountriesData($all_countries_data)
    {
        $str_length = strlen($all_countries_data) - 4;
        $all_countries_trimmed_data = substr($all_countries_data, 0, 2) . substr($all_countries_data, 3, $str_length);
        $hash = new Encrypter($this->en_key, $this->cipher);
        return $hash->decrypt($all_countries_trimmed_data);
    }

    /**
     * Fetch optimized countries data
     *
     * @return string
     */
    private function getOptimizedCountriesData()
    {
        $all_countries_data = $this->data->countriesHelper();
        $countries_data = $this->optimizeCountriesData($all_countries_data);
        // $std_codes_data = json_decode($std_codes_data, true);
        return $countries_data;
    }

    /**
     * Optimize states data
     *
     * @param $all_states_data
     * @return mixed
     */
    private function optimizeStatesData($all_states_data)
    {
        $str_length = strlen($all_states_data) - 15;
        $all_states_trimmed_data = substr($all_states_data, 0, 14) . substr($all_states_data, 15, $str_length);
        return unserialize($all_states_trimmed_data);
    }

    /**
     * Fetch optimized states data
     *
     * @return mixed
     */
    private function getOptimizedStatesData()
    {
        $all_states_data = $this->data->states();
        $states_data = $this->optimizeStatesData($all_states_data);
        return $states_data;
    }

    /**
     * Format states data
     *
     * @return array
     */
    private function formatStatesData()
    {
        $countries = $this->getOptimizedCountriesData();
        $states = $this->getOptimizedStatesData();
        $grouped_countries_collection = collect($countries)->groupBy('id');
        $result = [];
        foreach ($states as $state) {
            $country = $grouped_countries_collection->get($state['country_id']);
            $result[] = [
                'state' => $state['state_name'],
                'country' => $country[0]['country_name']
            ];
        }
        return $result;
    }

    /**
     * Returns all states.
     *
     * If pagination is enabled for states in config file
     * then the result contains paginated data otherwise all records wil be returned.
     *
     * @param null $page_number
     * @return array
     */
    public function states($page_number = null)
    {
        $page_number = ($page_number == null) ? 1 : $page_number;
        $states_data = $this->formatStatesData();
        if (config('world.pagination.states') == false) {
            return $states_data;
        }
        $per_page = config('world.pagination.states_per_page');
        $ceil_val = ceil(count($states_data) / $per_page);
        $request_url = request()->url();
        $total_records = count($states_data);
        $pagination_data = MyPaginate::getPagination($request_url, $page_number, $per_page,
            $ceil_val, $total_records);
        $data = collect($states_data)->forPage($page_number, $per_page)->values();
        $pagination_data['data'] = $data;
        return $pagination_data;
    }

    /**
     * Search state by any name
     *
     * @param null $search_key
     * @return array
     */
    public function searchStates($search_key = null)
    {
        if (is_null($search_key)) {
            return [];
        }
        $states = $this->formatStatesData();
        return array_values(array_filter($states, function($item) use ($search_key) {
            return starts_with(strtolower($item['state']), strtolower($search_key));
        }));
    }

    /**
     * Returns country names for states
     *
     * @return array
     */
    public function countriesForStates()
    {
        $countries = $this->getOptimizedCountriesData();
        return array_map(function($item) {
            return $item['country_name'];
        }, $countries);
    }

    /**
     * Returns all states belongs to given country name
     *
     * @param null $country_name
     * @return array
     */
    public function getStatesByCountry($country_name = null)
    {
        if (is_null($country_name)) {
            return [];
        }
        $states = $this->formatStatesData();
        return array_values(array_filter($states, function($item) use ($country_name) {
            return strtolower($item['country']) == strtolower($country_name);
        }));
    }

}