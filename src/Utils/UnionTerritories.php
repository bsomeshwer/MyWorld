<?php namespace Someshwer\MyWorld\Utils;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;

trait UnionTerritories
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

    private function optimizeTerritoriesData($all_territories_data)
    {
        $str_length = strlen($all_territories_data) - 4;
        $all_territories_trimmed_data = substr($all_territories_data, 0, 2) . substr($all_territories_data, 3, $str_length);
        $hash = new Encrypter($this->en_key, $this->cipher);
        return $hash->decrypt($all_territories_trimmed_data);
    }

    private function getOptimizedTerritoriesData()
    {
        $all_territories_data = $this->data->unionTerritories();
        $territories_data = $this->optimizeTerritoriesData($all_territories_data);
        return $territories_data;
    }

    private function formatTerritories($territories)
    {
        return collect($territories)->transform(function ($item, $key) {
            $data['name'] = $key;
            $data['display_name'] = str_replace('_', ' ', title_case($key));
            $data['capital'] = str_replace('_', ' ', title_case($item));
            $data['country'] = 'India';
            return $data;
        })->values();
    }

    public function unionTerritories()
    {
        $territories = $this->getOptimizedTerritoriesData();
        $formatted_territories = $this->formatTerritories($territories);
        return ['union_territories' => ['india' => $formatted_territories]];
    }

}