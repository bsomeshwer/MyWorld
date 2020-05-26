<?php namespace Someshwer\MyWorld\Utils;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;

/**
 * Author: Someshwer Bandapally
 * Date: 14-07-2018
 *
 * Provides all oceans names
 *
 * Class Oceans
 * @package Someshwer\MyWorld\Utils
 */
trait Oceans
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
     * Oceans constructor.
     * @param DataRepository $dataRepository
     */
    public function __construct(DataRepository $dataRepository)
    {
        $this->data = $dataRepository;
    }

    /**
     * Optimize oceans data
     *
     * @param $all_oceans_data
     * @return string
     */
    private function optimizeOceansData($all_oceans_data)
    {
        $str_length = strlen($all_oceans_data) - 4;
        $all_oceans_trimmed_data = substr($all_oceans_data, 0, 2) . substr($all_oceans_data, 3, $str_length);
        $hash = new Encrypter($this->en_key, $this->cipher);
        return $hash->decrypt($all_oceans_trimmed_data);
    }

    /**
     * Returns optimized oceans data
     *
     * @return string
     */
    private function getOptimizedOceansData()
    {
        $all_oceans_data = $this->data->oceans();
        $continents_data = $this->optimizeOceansData($all_oceans_data);
        return $continents_data;
    }

    /**
     * Formats oceans data
     *
     * @param $oceans
     * @return $this
     */
    private function formatOceans($oceans)
    {
        return collect($oceans)->transform(function($item) {
            $data['name'] = $item;
            $data['display_name'] = title_case($item);
            $data['also_called_as'] = ($item == 'antarctic') ? 'Southern Ocean' : null;
            return $data;
        });
    }

    /**
     * Returns all oceans names
     *
     * @return array
     */
    public function oceans()
    {
        $oceans = $this->getOptimizedOceansData();
        $formatted_oceans = $this->formatOceans($oceans);
        return ['oceans' => $formatted_oceans];
    }

}