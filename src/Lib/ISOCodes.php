<?php namespace Someshwer\MyWorld\Lib;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;

class ISOCodes
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

    private function optimizeISOData($all_iso_data)
    {
        $str_length = strlen($all_iso_data) - 4;
        $all_iso_trimmed_data = substr($all_iso_data, 0, 2) . substr($all_iso_data, 3, $str_length);
        // $hash = new Encrypter($this->en_key, Config::get('app.cipher'));
        $hash = new Encrypter($this->en_key, $this->cipher);
        $all_iso = $hash->decrypt($all_iso_trimmed_data);
        return $all_iso;
    }

    private function getOptimizedIsoData()
    {
        $all_countries_iso_data = $this->data->countriesISOData();
        $iso_data = $this->optimizeISOData($all_countries_iso_data);
        return $iso_codes = json_decode($iso_data, true);
    }

    private function optimizeIsoResult($iso_codes, $alpha_code)
    {
        $group_by = ctype_digit($alpha_code) ? 'country_numeric_code' : ((strlen($alpha_code) == 2) ? 'alpha_2' : 'alpha_3');
        $alpha_code = ctype_digit($alpha_code) ? (int)$alpha_code : strtoupper($alpha_code);
        $result = collect($iso_codes)->groupBy($group_by)->get($alpha_code);
        if ($result == null) {
            return $this->isoErrorResponse();
        } else {
            return response(['success' => true, 'iso_info' => $result->first()], 200);
        }
    }

    private function formatRegions($iso_codes)
    {
        $regions = collect($iso_codes)->groupBy('region')->all();
        $new_regions = [];
        foreach ($regions as $key => $region) {
            if ($key == '') {
                $key = $region[0]['name'];
            }
            $new_regions[$key] = $region;
        }
        return $new_regions;
    }

    private function filterRegions($regions, $region)
    {
        return collect($regions)->filter(function ($item, $key) use ($region) {
            return ($region == null) ? true : (strpos(strtolower($key), strtolower($region)) === 0) ? true : false;
        });
    }

    public function isoCodes()
    {
        return $this->getOptimizedIsoData();
    }

    public function regions()
    {
        $iso_codes = $this->getOptimizedIsoData();
        $regions_data = $this->formatRegions($iso_codes);
        $regions = array_keys($regions_data);
        return collect($regions)->map(function ($item) {
            return ['key' => strtolower($item), 'name' => $item];
        });
    }

    public function searchIsoCodes($key)
    {
        //TODO:: Implement it soon
    }

    public function filterIsoInfoByCountryName($iso_codes, $name)
    {
        return collect($iso_codes)->map(function ($item, $key) {
            $item['display_name'] = $item['name'];
            $item['name'] = strtolower(studly_case($item['name']));
            return $item;
        })->groupBy('name')->filter(function ($item, $key) use ($name) {
            return strpos($key, $name) === 0;
        })->collapse();
    }

    public function isoInfoByCountryName($name = null)
    {
        if ($name == null) return [];
        $iso_codes = $this->getOptimizedIsoData();
        $result = $this->filterIsoInfoByCountryName($iso_codes, $name);
        if ($result == null) return [];
        return $result;
    }

    public function isoInfoByCode($code = null)
    {
        if ($code == null) {
            return $this->isoErrorResponse('NO_PARAM');
        }
        $iso_codes = $this->getOptimizedIsoData();
        return $this->optimizeIsoResult($iso_codes, $code);
    }

    public function isoCodesByRegion($region = null)
    {
        $iso_codes = $this->getOptimizedIsoData();
        $regions = $this->formatRegions($iso_codes);
        return $this->filterRegions($regions, $region);
    }

    private function isoErrorResponse($param = null)
    {
        $status = 'INVALID_CODE';
        $message = 'Invalid ISO code!';
        if ($param == 'NO_PARAM') {
            $status = 'CODE_REQUIRED';
            $message = 'ISO code parameter is required';
        }
        return response(['error' => true, 'status' => $status, 'message' => $message], 422);
    }

}