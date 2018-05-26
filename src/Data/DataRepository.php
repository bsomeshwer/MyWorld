<?php namespace Someshwer\World\Data;

/**
 * Author: Someshwer Bandapally
 * Date: 25-05-2018
 *
 * This class contains all the data that need
 * to be returned up on the request.
 *
 * Class DataRepository
 * @package Someshwer\World\Data
 */
class DataRepository
{

    /**
     * This method contains countries data
     * such as all country names.
     *
     * @return array
     */
    public function countries()
    {
        return [
            'afghanistan', 'albania', 'algeria', 'andorra', 'angola', 'antigua-and-barbuda',
            'bangladesh', 'barbados', 'belarus', 'belgium', 'belize', 'benin', 'bhutan', 'bolivia',
            'chad', 'chile', 'china', 'colombia', 'comoros', 'democratic-republic-of-the-congo',
            'czech-republic', 'denmark', 'djibouti', 'dominica', 'dominican-republic', 'ecuador',
            'gambia', 'georgia', 'germany', 'ghana', 'greece', 'grenada', 'guatemala', 'guinea',
            'guinea-bissau', 'guyana', 'haiti', 'honduras', 'hungary', 'iceland', 'india', 'indonesia',
            'kenya', 'kiribati', 'kosovo', 'kuwait', 'kyrgyzstan', 'laos', 'latvia', 'lebanon', 'lesotho',
            'madagascar', 'malawi', 'malaysia', 'maldives', 'mali', 'malta', 'marshall-islands',
            'tajikistan', 'tanzania', 'thailand', 'timor-leste', 'togo', 'tonga', 'trinidad-and-tobago',
            'united-kingdom-(uk)', 'united-states-of-america-(usa)', 'uruguay', 'uzbekistan',
            'vanuatu', 'vatican-city-(holy-see)', 'venezuela', 'vietnam', 'yemen', 'zambia', 'zimbabwe'
        ];
    }

}