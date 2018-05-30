# Laravel - My World

[![Total Downloads](https://poser.pugx.org/someshwer/my-world/downloads.svg)](https://packagist.org/packages/someshwer/my-world)
[![Latest Stable Version](https://poser.pugx.org/someshwer/my-world/v/stable.svg)](https://packagist.org/packages/someshwer/my-world)
[![Latest Unstable Version](https://poser.pugx.org/someshwer/my-world/v/unstable.svg)](https://packagist.org/packages/someshwer/my-world)

Laravel MyWorld is a bundle for Laravel, providing useful world information that is all country names, timezones,
ISO country codes, STD codes of countries  etc.

As of now this package only provides countries data that is all country names for all most 195 countries over the world.

**Please note that always use latest version of this package and must use Laravel 5 and above versions only,
this package may not properly work with older versions of Laravel.

## Installation

Open terminal, go to root directory and run the following command:

    composer require someshwer/my-world

The package will be installed.

Edit `app/config/app.php` and add the `provider` and `filter`

    'providers' => [
        Someshwer\MyWorld\WorldDataServiceProvider::class,
    ]

Now add the alias at app/config/app.php`.

    'aliases' => [
         'World' => Someshwer\MyWorld\Facades\World::class,
    ]

You can start by publishing the configuration. This is an optional step since the package does not contain configuration to publish.
Hence it is better to ignore this step for publishing by the following command.

    $ php artisan vendor:publish

That's it !! You are done with package installation...

## Usage:

Next use the package as follows:

    1. World::countries();

This will return all the country names in the world.

    2. World::searchCountry('xx');

Where the parameter 'xx' is some search string. You can search the countries by search string.


