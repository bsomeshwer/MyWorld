<?php  namespace Someshwer\MyWorld\Lib;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;

class Continents extends Oceans
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

    private function getOptimizedContinentsData()
    {
        $all_continents_data = $this->data->continents();
        $continents_data = $this->optimizeContinentsData($all_continents_data);
        // return $continents_data = json_decode($continents_data, true);
        return $continents_data;
    }

    public function optimizeContinentsData($all_continents_data)
    {
        $str_length = strlen($all_continents_data) - 4;
        $all_continents_trimmed_data = substr($all_continents_data, 0, 2) . substr($all_continents_data, 3, $str_length);
        // $hash = new Encrypter($this->en_key, Config::get('app.cipher'));
        $hash = new Encrypter($this->en_key, $this->cipher);
        $all_continents = $hash->decrypt($all_continents_trimmed_data);
        return $all_continents;
    }

    private function formatContinents($continents)
    {
        return collect($continents)->transform(function ($item) {
            $data['name'] = $item;
            $data['display_name'] = str_replace('_', ' ', title_case($item));
            $data['also_called_as'] = ($item == 'australia') ? 'Oceania' : null;
            return $data;
        });
    }

    public function continents()
    {
        $continents = $this->getOptimizedContinentsData();
        $formatted_continents = $this->formatContinents($continents);
        return ['continents' => $formatted_continents];
    }

}