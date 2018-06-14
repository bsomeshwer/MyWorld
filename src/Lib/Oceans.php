<?php namespace Someshwer\MyWorld\Lib;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;

class Oceans
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

    private function optimizeOceansData($all_oceans_data)
    {
        $str_length = strlen($all_oceans_data) - 4;
        $all_oceans_trimmed_data = substr($all_oceans_data, 0, 2) . substr($all_oceans_data, 3, $str_length);
        $hash = new Encrypter($this->en_key, $this->cipher);
        return $hash->decrypt($all_oceans_trimmed_data);
    }

    private function getOptimizedOceansData()
    {
        $all_oceans_data = $this->data->oceans();
        $continents_data = $this->optimizeOceansData($all_oceans_data);
        return $continents_data;
    }

    private function formatOceans($oceans)
    {
        return collect($oceans)->transform(function ($item) {
            $data['name'] = $item;
            $data['display_name'] = title_case($item);
            $data['also_called_as'] = ($item == 'antarctic') ? 'Southern Ocean' : null;
            return $data;
        });
    }

    public function oceans()
    {
        $oceans = $this->getOptimizedOceansData();
        $formatted_oceans = $this->formatOceans($oceans);
        return ['oceans' => $formatted_oceans];
    }


}