# Laravel - My World

[![Total Downloads](https://poser.pugx.org/someshwer/my-world/downloads.svg)](https://packagist.org/packages/someshwer/my-world)
[![Latest Stable Version](https://poser.pugx.org/someshwer/my-world/v/stable.svg)](https://packagist.org/packages/someshwer/my-world)
[![Latest Unstable Version](https://poser.pugx.org/someshwer/my-world/v/unstable.svg)](https://packagist.org/packages/someshwer/my-world)

Laravel MyWorld is a bundle for Laravel, providing useful world information that is all country names, timezones,
ISO country codes, STD codes of countries  etc.

As of now this package only provides countries data that is all country names for all most 195 countries over the world
along with continent names, ocean names, union territories names, world wonders names, ISO codes and ISO information,
timezones and timezones information, and currencies and currency codes and symbols information.

Note: As of now the support for database option is not there, It will be implemented soon.
(See this area for new updates.)

**Please note that always use latest version of this package and must use Laravel 5 and above versions only,
as this package may not properly work with older versions of Laravel.

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

It returns all the country names in the world.

    2. World::searchCountry('xx');

Where the parameter 'xx' is the search string. You can search the countries by search string. If search
string is not provided then all country names will be returned.

    3. World::continents();

It returns all continents names.

    4. World::oceans();

It returns all oceans names in the world.

    5. World::unionTerritories();

It returns all union territories names in the world.

    6. World::wonders();

It returns all wonders names in the world.

    7. World::isoCodes();

It returns all iso codes of the countries in the world.

    8. World::regions();

It returns all regions names for iso codes.

    9. World::isoInfoByCountryName('country_name');

Where the parameter 'country_name' is the country name. You can search iso information by country name. If country
name is not provided or the country name provided as parameter is not matched then in those both cases
an empty array will be returned.

    10. World::isoInfoByCode('country_code');

Where the parameter 'country_code' is the country code. You can search iso information by country code. If country
code is not provided or the country code provided as parameter is not matched then in those both cases
an empty array will be returned.

    11. World::isoCodesByRegion('region');

Where the parameter 'region' is the region name. You can search iso information by region name. If region
name is not provided or the region name provided as parameter is not matched then in those both cases
an empty array will be returned.

    12. World::searchIsoCodes('xx');

Where the parameter 'xx' is the search string. You can search iso information by any search string. If search
string is not provided or the search string provided as parameter is not matched then in those both cases
an empty array will be returned.

    13. World::timezones();

It returns all timezones information in the world.

    14. World::timezoneRegions();

It returns all timezone region names in the world.

    15. World::timezonesByRegion('region_name');

It returns all timezone information for the provided region. If region name provided is not matched or
if region name is null in that case an empty array will be returned.

    16. World::searchTimezone('xx');

You can search timezones by either country name or timezone name. Where the parameter 'xx' is the search string.
You can search timezones by any search string. If search string is not provided or the search string provided
as parameter is not matched then in those both cases an empty array will be returned.

    17. World::currencies();

It returns all currency names and their information like country name, country code, currency code,
and currency symbol for almost currencies in the world.

    18. World::searchCurrency('xx');

You can search the currency by either country name or currency name. Where the parameter 'xx' is the search string.
You can search currencies by any search string. If search string is not provided or the search string provided
as parameter is not matched then in those both cases an empty array will be returned.

    19. World::currencyByCountryName('country_name');

You can search the currency by country name. If the country name provided as parameter is null or
if it is not matched with any value in the database files, in that case an empty array will be returned.

    20. World::currencyByCountryCode('country_code');

You can search the currency by country code. If the country code provided as parameter is null or
if it is not matched with any value in the database, in that case an empty array will be returned as response.

    21. World::currencyByCurrencyName('currency_name');

You can search the currency by currency name. If the currency name provided as parameter is null or
if it is not matched with any value in the database files, in that case an empty array will be returned.

    22. World::currencyByCountryCode('currency_code');

You can search the currency by currency code. If the currency code provided as parameter is null or
if it is not matched with any value in the database, in that case an empty array will be returned as response.







