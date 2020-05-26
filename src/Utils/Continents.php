<?php

namespace Someshwer\MyWorld\Utils;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;

/**
 * Author: Someshwer Bandapally
 * Date: 14-07-2018.
 *
 * This class gives the list of continents names
 *
 * Class Continents
 */
trait Continents
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
     * Continents constructor.
     *
     * @param DataRepository $dataRepository
     */
    public function __construct(DataRepository $dataRepository)
    {
        $this->data = $dataRepository;
    }

    /**
     * Get optimized continents data.
     *
     * @return string
     */
    private function getOptimizedContinentsData()
    {
        $all_continents_data = $this->data->continents();
        $continents_data = $this->optimizeContinentsData($all_continents_data);
        // return $continents_data = json_decode($continents_data, true);
        return $continents_data;
    }

    /**
     * Optimize continents data.
     *
     * @param $all_continents_data
     *
     * @return string
     */
    private function optimizeContinentsData($all_continents_data)
    {
        $str_length = strlen($all_continents_data) - 4;
        $all_continents_trimmed_data = substr($all_continents_data, 0, 2).substr($all_continents_data, 3, $str_length);
        // $hash = new Encrypter($this->en_key, Config::get('app.cipher'));
        $hash = new Encrypter($this->en_key, $this->cipher);
        $all_continents = $hash->decrypt($all_continents_trimmed_data);

        return $all_continents;
    }

    /**
     * Format continents.
     *
     * @param $continents
     *
     * @return $this
     */
    private function formatContinents($continents)
    {
        return collect($continents)->transform(function ($item) {
            $data['name'] = $item;
            $data['display_name'] = str_replace('_', ' ', title_case($item));
            $data['also_called_as'] = ($item == 'australia') ? 'Oceania' : null;

            return $data;
        });
    }

    /**
     * Get list of continents names.
     *
     * @return array
     */
    public function continents()
    {
        $continents = $this->getOptimizedContinentsData();
        $formatted_continents = $this->formatContinents($continents);

        return ['continents' => $formatted_continents];
    }
}
