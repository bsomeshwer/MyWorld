<?php
/**
 *
 * Created by Someshwer<bsomeshwer89@gmail.com>.
 * User: Someshwer
 * Date: 07/08/2018
 * Time: 01:39 AM
 */

Route::get('getMyWorldPackageInfo', function () {

    return [
        'package_name' => 'Laravel - My World',
        'description' => 'Laravel MyWorld is a bundle for Laravel, providing useful world information that is all country names, timezones, ISO country codes, STD codes of countries  etc.
            This package only provides countries data that is all country names for all most 195 countries over the world along with continent names, ocean names, union territories names, world wonders names, ISO codes and ISO information, timezones and timezones information, and currencies and currency codes and symbols information.
            Also provides country wise states and state wise cities information.',
        'latest_release' => '2.4.8',
        'stable_version' => '2.4.8',
        'author' => 'Someshwer Bandapally'
    ];

});