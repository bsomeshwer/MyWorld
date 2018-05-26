<?php namespace Someshwer\World\Res;

use Someshwer\World\Data\DataRepository;

/**
 * Created by PhpStorm.
 * User: babi
 * Date: 26/5/18
 * Time: 12:06 PM
 */
class Countries
{

    private $data;

    public function __construct(DataRepository $dataRepository)
    {
        $this->data = $dataRepository;
    }

    public function all()
    {
        $all_countries = $this->data->countries();
        $countries = collect($all_countries)->map(function ($item) {
            // return title_case(str_replace('-',' ', $item));
            return studly_case($item);
        });
        return ['countries' => $countries];
    }

    public function searchCountry($search_string)
    {
        $all_countries = $this->data->countries();
        $countries = array_map(function ($it) {
            return studly_case($it);
        }, array_filter($all_countries, function ($item) use ($search_string) {
            return strpos($item, strtolower($search_string)) === 0;
        }));
        return ['countries' => array_values($countries)];
    }

}