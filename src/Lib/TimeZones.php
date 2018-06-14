<?php namespace Someshwer\MyWorld\Lib;

use Someshwer\MyWorld\Data\DataRepository;

class TimeZones
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
        // parent::__construct($dataRepository);
        $this->data = $dataRepository;
    }


}