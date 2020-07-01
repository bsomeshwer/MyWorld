<?php

namespace Someshwer\WorldCountries\Lib;

use Someshwer\WorldCountries\Data\DataRepository;
use Someshwer\WorldCountries\Utils\Continents;
use Someshwer\WorldCountries\Utils\Oceans;
use Someshwer\WorldCountries\Utils\UnionTerritories;
use Someshwer\WorldCountries\Utils\Wonders;

/**
 * Author: Someshwer Bandapally
 * Date: 26-05-2018.
 *
 * This class is a repository contains
 * different methods to provide different
 * implementations.
 *
 * Class World
 */
class World extends Countries
{
    use Continents;
    use Oceans;
    use Wonders;
    use UnionTerritories;

    /**
     * @var DataRepository
     */
    private $data;

    /**
     * World constructor.
     *
     * @param DataRepository $dataRepository
     */
    public function __construct(DataRepository $dataRepository)
    {
        parent::__construct($dataRepository);
        $this->data = $dataRepository;
    }

    /**
     * Tells some useful information about this package.
     */
    public function info()
    {
        return [
            'package_name' => 'Laravel - My World',
            'description'  => 'Laravel WorldCountries is a bundle for Laravel, providing useful world information that is all country names, timezones, ISO country codes, STD codes of countries  etc.
            This package only provides countries data that is all country names for all most 195 countries over the world along with continent names, ocean names, union territories names, world wonders names, ISO codes and ISO information, timezones and timezones information, and currencies and currency codes and symbols information.
            Also provides country wise states and state wise cities information.',
            'latest_release' => '3.6',
            'stable_version' => '3.6',
            'author'         => 'Someshwer Bandapally',
        ];
    }
}
