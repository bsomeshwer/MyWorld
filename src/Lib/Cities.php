<?php namespace Someshwer\MyWorld\Lib;


use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;
use Someshwer\MyWorld\Helpers\MyPaginate;

class Cities
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
     * Optimize cities data
     *
     * @param $all_cities_data
     * @return mixed
     */
    private function optimizeCitiesData($all_cities_data)
    {
        $str_length = strlen($all_cities_data) - 15;
        $all_cities_trimmed_data = substr($all_cities_data, 0, 14) . substr($all_cities_data, 15, $str_length);
        return unserialize($all_cities_trimmed_data);
    }

    /**
     * Fetch optimized cities data
     *
     * @return mixed
     */
    private function getOptimizedCitiesData()
    {
        $all_cities_data = $this->data->cities();
        $cities_data = $this->optimizeCitiesData($all_cities_data);
        return $cities_data;
    }

    /**
     * Format cities data
     *
     * @return array
     */
    private function formatCitiesData()
    {
        $countries = $this->getOptimizedCountriesData();
        $states = $this->getOptimizedStatesData();
        $cities = $this->getOptimizedCitiesData();
        $grouped_states_collection = collect($states)->groupBy('id');
        $grouped_countries_collection = collect($countries)->groupBy('id');
        $result = [];
        foreach ($cities as $city) {
            $state = $grouped_states_collection->get($city['state_id']);
            $country = $grouped_countries_collection->get($state[0]['country_id']);
            $result[] = [
                'city' => $city['city_name'],
                'state' => $state[0]['state_name'],
                'country' => $country[0]['country_name']
            ];
        }
        return $result;
    }

    /**
     * Returns all cities.
     *
     * If pagination is enabled for cities in config file
     * then the result contains paginated data otherwise all records wil be returned.
     *
     * @param null $page_number
     * @return array
     */
    public function cities($page_number = null)
    {
        $page_number = ($page_number == null) ? 1 : $page_number;
        $cities_data = $this->formatCitiesData();
        if (config('world.pagination.cities') == false) {
            return $cities_data;
        }
        $per_page = config('world.pagination.cities_per_page');
        $ceil_val = ceil(count($cities_data) / $per_page);
        $request_url = request()->url();
        $total_records = count($cities_data);
        $pagination_data = MyPaginate::getPagination($request_url, $page_number, $per_page,
            $ceil_val, $total_records);
        $data = collect($cities_data)->forPage($page_number, $per_page)->values();
        $pagination_data['data'] = $data;
        return $pagination_data;

    }

    /**
     * Search cities by any search string
     *
     * @param null $search_key
     * @return array
     */
    public function searchCities($search_key = null)
    {
        if (is_null($search_key)) {
            return [];
        }
        $cities = $this->formatCitiesData();
        return array_values(array_filter($cities, function ($item) use ($search_key) {
            return starts_with(strtolower($item['city']), strtolower($search_key));
        }));
    }

    /**
     * Get all state names if you wish to
     * fetch cities by state name
     *
     * @return array
     */
    public function statesForCities()
    {
        $states = $this->getOptimizedStatesData();
        return array_map(function ($item) {
            return $item['state_name'];
        }, $states);
    }

    /**
     * Get all country names if you wish to
     * fetch cities by country name
     *
     * @return array
     */
    public function countriesForCities()
    {
        $countries = $this->getOptimizedCountriesData();
        return array_map(function ($item) {
            return $item['country_name'];
        }, $countries);
    }

    /**
     * Get cities by state name
     *
     * @param null $state_name
     * @return array
     */
    public function getCitiesByStateName($state_name = null)
    {
        if (is_null($state_name)) {
            return [];
        }
        $cities = $this->formatCitiesData();
        return array_values(array_filter($cities, function ($item) use ($state_name) {
            return strtolower($item['state']) == strtolower($state_name);
        }));
    }

    /**
     * Get cities by country name
     *
     * @param null $country_name
     * @return array
     */
    public function getCitiesByCountryName($country_name = null)
    {
        if (is_null($country_name)) {
            return [];
        }
        $cities = $this->formatCitiesData();
        return array_values(array_filter($cities, function ($item) use ($country_name) {
            return strtolower($item['country']) == strtolower($country_name);
        }));
    }

}