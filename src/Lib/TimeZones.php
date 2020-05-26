<?php

namespace Someshwer\MyWorld\Lib;

use Someshwer\MyWorld\Data\DataRepository;

/**
 * Author: Someshwer Bandapally
 * Date: 14-07-2018.
 *
 * This class provides timezones info
 *
 * Class TimeZones
 */
class TimeZones extends Currencies
{
    /**
     * @var DataRepository
     */
    private $data;

    /**
     * TimeZones constructor.
     *
     * @param DataRepository $dataRepository
     */
    public function __construct(DataRepository $dataRepository)
    {
        parent::__construct($dataRepository);
        $this->data = $dataRepository;
    }

    /**
     * This method prepares timezones.
     *
     * @return array
     */
    private function prepareTimezones()
    {
        $timezone_identifiers_list = $this->data->timezones();
        $zones_array = [];
        $timestamp = time();
        foreach ($timezone_identifiers_list as $key => $zone) {
            date_default_timezone_set($zone);
            $zones_array[$key]['region'] = $zones_array[$key]['region'] = substr($zone, 0, strpos($zone, '/'));
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT '.date('P', $timestamp);
        }

        return $zones_array;
    }

    /**
     * Returns all timezones.
     *
     * @return array
     */
    public function timezones()
    {
        return $this->prepareTimezones();
    }

    /**
     * Returns all timezones regions.
     *
     * @return array
     */
    public function timezoneRegions()
    {
        $timezone_regions = $this->prepareTimezones();
        $timezone_regions_group = collect($timezone_regions)->groupBy('region')->keys();
        $regions = [];
        foreach ($timezone_regions_group as $item) {
            if ($item != '') {
                $regions[] = $item;
            }
        }

        return $regions;
    }

    /**
     * Fetches and returns timezones by regions.
     *
     * @param null $region
     *
     * @return array|mixed
     */
    public function timezonesByRegion($region = null)
    {
        if (!$region) {
            return [];
        }
        $timezone_regions = $this->prepareTimezones();
        $timezone_regions_group = collect($timezone_regions)->groupBy('region');
        $regional_timezones = $timezone_regions_group->get($region);
        if (!$regional_timezones) {
            return [];
        }

        return $regional_timezones;
    }

    /**
     * Searches timezones by name.
     *
     * @param $search_key
     *
     * @return array|static
     */
    public function searchTimezone($search_key)
    {
        if (!$search_key || ($search_key == '/')) {
            return [];
        }
        $timezones = $this->prepareTimezones();
        $filtered_timezones = collect($timezones)->filter(function ($item) use ($search_key) {
            return strpos(strtolower($item['zone']), strtolower($search_key)) !== false;
        })->values();

        return $filtered_timezones;
    }
}
