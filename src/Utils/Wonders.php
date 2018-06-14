<?php namespace Someshwer\MyWorld\Utils;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;

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

    private function optimizeWondersData($all_wonders_data)
    {
        $str_length = strlen($all_wonders_data) - 4;
        $all_wonders_trimmed_data = substr($all_wonders_data, 0, 2) . substr($all_wonders_data, 3, $str_length);
        $hash = new Encrypter($this->en_key, $this->cipher);
        return $hash->decrypt($all_wonders_trimmed_data);
    }

    private function getOptimizedWondersData()
    {
        $all_wonders_data = $this->data->wonders();
        $territories_data = $this->optimizeWondersData($all_wonders_data);
        return $territories_data;
    }

    private function formatWonders($wonders)
    {
        return collect($wonders)->transform(function ($item, $key) {
            $data['name'] = $key;
            $data['display_name'] = str_replace('_', ' ', title_case($key));
            $data['location'] = str_replace('_', ' ', title_case($item));
            return $data;
        })->values();
    }

    public function wonders()
    {
        $wonders = $this->getOptimizedWondersData();
        $formatted_wonders = $this->formatWonders($wonders);
        return ['wonders_of_the_world' => $formatted_wonders];
    }

}