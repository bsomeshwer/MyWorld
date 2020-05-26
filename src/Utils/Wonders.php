<?php

namespace Someshwer\WorldCountries\Utils;

use Illuminate\Encryption\Encrypter;
use Someshwer\WorldCountries\Data\DataRepository;

/**
 * Author: Someshwer Bandapally
 * Date: 14-07-2018.
 *
 * Provides the data of world wonders
 *
 * Class Wonders
 */
trait Wonders
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
        $this->data = $dataRepository;
    }

    /**
     * Optimizes wonders data.
     *
     * @param $all_wonders_data
     *
     * @return string
     */
    private function optimizeWondersData($all_wonders_data)
    {
        $str_length = strlen($all_wonders_data) - 4;
        $all_wonders_trimmed_data = substr($all_wonders_data, 0, 2).substr($all_wonders_data, 3, $str_length);
        $hash = new Encrypter($this->en_key, $this->cipher);

        return $hash->decrypt($all_wonders_trimmed_data);
    }

    /**
     * Fetches wonders data from a file and processes it.
     *
     * @return string
     */
    private function getOptimizedWondersData()
    {
        $all_wonders_data = $this->data->wonders();
        $territories_data = $this->optimizeWondersData($all_wonders_data);

        return $territories_data;
    }

    /**
     * Formats wonders data.
     *
     * @param $wonders
     *
     * @return static
     */
    private function formatWonders($wonders)
    {
        return collect($wonders)->transform(function ($item, $key) {
            $data['name'] = $key;
            $data['display_name'] = str_replace('_', ' ', title_case($key));
            $data['location'] = str_replace('_', ' ', title_case($item));

            return $data;
        })->values();
    }

    /**
     * Returns all wonders names.
     *
     * @return array
     */
    public function wonders()
    {
        $wonders = $this->getOptimizedWondersData();
        $formatted_wonders = $this->formatWonders($wonders);

        return ['wonders_of_the_world' => $formatted_wonders];
    }
}
