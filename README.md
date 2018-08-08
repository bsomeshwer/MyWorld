# Laravel - My World

[![Total Downloads](https://poser.pugx.org/someshwer/my-world/downloads.svg)](https://packagist.org/packages/someshwer/my-world)
[![Latest Stable Version](https://poser.pugx.org/someshwer/my-world/v/stable.svg)](https://packagist.org/packages/someshwer/my-world)
[![Latest Unstable Version](https://poser.pugx.org/someshwer/my-world/v/unstable.svg)](https://packagist.org/packages/someshwer/my-world)

Laravel MyWorld is a bundle for Laravel, providing useful world information that is all country names, timezones,
ISO country codes, STD codes of countries  etc.

This package only provides countries data that is all country names for all most 195 countries over the world
along with continent names, ocean names, union territories names, world wonders names, ISO codes and ISO information,
timezones and timezones information, and currencies and currency codes and symbols information.

Also provides country wise states and state wise cities information.

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

You can start by publishing the configuration.

    $ php artisan vendor:publish --provider="Someshwer\MyWorld\WorldDataServiceProvider"

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
You can also get paginated result for iso codes. If you want pagination for iso codes then just set 'iso' option to TRUE in config/world.php configuration file. Also you can set how many number of records you want to display per page.
Just go through config options available in config/world.php file.

When you use pagination, you must give the page number from the request url.
 For example: You are calling iso codes like World::isoCodes(). For pagination you must send the parameter as
 World::isoCodes($request->get('page')) and url should be like 'http://localhost:8000/isoCodes?page=3'.

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

    23. World::stdCodes();

It returns all the STD codes for all countries.

    24. World::searchStdCodes('xx');

You can search the STD code by search string. If the search string provided as parameter is null or
if it is not matched with any value in the database, in that case an empty array will be returned as response.

    25. World::stdCodeByCountryName('country_name');

You can search the STD code by country name. If the country name provided as parameter is null or
if it is not matched with any value in the database, in that case an empty array will be returned as response.

    26. World::stdCodeByCountryCode('country_code');

You can search the STD code by country code. If the country code provided as parameter is null or
if it is not matched with any value in the database, in that case an empty array will be returned as response.

    27. World::states();

It returns all state names along with it's country name.
You can also get paginated result for states. If you want pagination for states then just set 'states' option to TRUE in config/world.php configuration file. Also you can set how many number of records you want to display per page.
Just go through config options available in config/world.php file.

When you use pagination, you must give the page number from the request url.
 For example: You are calling states like World::states(). For pagination you must send the parameter as
 World::states($request->get('page')) and url should be like 'http://localhost:8000/states?page=3'.

    28. World::searchStates('search_key');

You can search states by any search string. If the search key provided as parameter is null or
if it is not matched with any value in the database, an empty array will be returned as response.

    29. World::countriesForStates('country_code');

It returns all country names in case you want to search states by a country.

    30. World::getStatesByCountry('country_name');

You can search the states by a country name. If the country name provided as parameter is null or
if it is not matched with any value in the database, an empty array will be returned as response.

    31. World::cities();

It returns all city names along with state and country to which it belong to.
You can also get paginated result for cities. If you want pagination for cities then just set 'cities' option to TRUE in config/world.php configuration file. Also you can set how many number of records you want to display per page.
Just go through configuration options available in config/world.php file.

When you use pagination, you must give the page number from the request url.
 For example: You are calling cities like World::cities(). For pagination you must send the parameter as
 World::cities($request->get('page')) and url should be like 'http://localhost:8000/cities?page=3'.

For pagination: Url must be similar to "http://localhost:8000/cities?page=3"
 cities() function calling must be like "return World::cities($request->get('page'));".
 Otherwise pagination may not work properly.

    32. World::searchCities('search_key');

You can search the cities by any search string. If the search key provided as parameter is null or
if it is not matched with any value in the database, then an empty array will be returned as response.

    33. World::statesForCities();

It returns all state names in case you want to search cities by a state.

    34. World::countriesForCities();

It returns all country names in case you want to search cities by a country.

    35. World::getCitiesByStateName('state_name');

You can search the cities by a state. If the state name provided as parameter is null or
if it is not matched with any value in the database, then an empty array will be returned as response.

    36. World::getCitiesByCountryName('country_name');

You can search cities by a country. If the country name provided as parameter is null or
if it is not matched with any value in the database, an empty array will be returned as response.



