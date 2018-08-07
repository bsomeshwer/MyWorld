<?php namespace Someshwer\MyWorld\Lib;

use Someshwer\MyWorld\Data\DataRepository;
use Someshwer\MyWorld\Utils\Continents;
use Someshwer\MyWorld\Utils\Oceans;
use Someshwer\MyWorld\Utils\UnionTerritories;
use Someshwer\MyWorld\Utils\Wonders;

/**
 * Author: Someshwer Bandapally
 * Date: 26-05-2018
 *
 * This class is a repository contains
 * different methods to provide different
 * implementations.
 *
 * Class World
 * @package Someshwer\World\Res
 */
class World extends Countries
{

    use Continents, Oceans, Wonders, UnionTerritories;

    /**
     * @var DataRepository
     */
    private $data;

    /**
     * World constructor.
     * @param DataRepository $dataRepository
     */
    public function __construct(DataRepository $dataRepository)
    {
        parent::__construct($dataRepository);
        $this->data = $dataRepository;
    }

    /**
     * Tells some useful information about this package
     */
    public function info()
    {
        return [
            'package_name' => 'Laravel - My World',
            'description' => 'Laravel MyWorld is a bundle for Laravel, providing useful world information that is all country names, timezones, ISO country codes, STD codes of countries  etc.
            This package only provides countries data that is all country names for all most 195 countries over the world along with continent names, ocean names, union territories names, world wonders names, ISO codes and ISO information, timezones and timezones information, and currencies and currency codes and symbols information.
            Also provides country wise states and state wise cities information.',
            'latest_release' => '2.3.9',
            'stable_version' => '2.3.9',
            'author' => 'Someshwer Bandapally'
        ];
    }

}

