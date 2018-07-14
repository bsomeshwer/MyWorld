<?php namespace Someshwer\MyWorld\Lib;

use Illuminate\Encryption\Encrypter;
use Someshwer\MyWorld\Data\DataRepository;
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
class World extends Continents
{

    use Oceans, Wonders, UnionTerritories;

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
        //TODO:: Tell something useful about package.
    }

}

