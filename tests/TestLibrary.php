<?php
/**
 * Created by PhpStorm.
 * User: babi
 * Date: 13/6/20
 * Time: 11:35 PM
 */

namespace Tests;

use Someshwer\WorldCountries\Facades\World;

class TestLibrary extends TestCase
{

    /** @test */
    public function testCountries()
    {
        // Arrange
        $countries = World::countries();

        // Assert
        $this->assertGreaterThan(count($countries), 200);
    }

    /** @test */
    public function testSearchCountry()
    {
        // Arrange
        $country = World::searchCountry('india');

        // Assert
        $this->assertEquals(count($country) , 1);
    }

    /** @test */
    public function testCurrencies()
    {
        // Arrange
        $currencies = World::currencies();

        // Assert
        $this->assertGreaterThan(30, count($currencies));
    }

    /** @test */
    public function testSearchCurrency()
    {
        // Arrange
        $currencies = World::searchCurrency('I');

        // Assert
        $this->assertGreaterThan(2, count($currencies));
    }

    /** @test */
    public function testCurrencyByCountryName()
    {
        // Arrange
        $currency = World::currencyByCountryName('India');

        // Assert
        $this->assertEquals(1, count($currency));
    }

    /** @test */
    public function testCurrencyByCountryCode()
    {
        // Arrange
        $currency = World::currencyByCountryCode('AF');

        // Assert
        $this->assertGreaterThan(0, count($currency));
    }

    /** @test */
    public function testCurrencyByCurrencyName()
    {
        // Arrange
        $currency = World::currencyByCurrencyName('Dollar');

        // Assert
        $this->assertGreaterThan(20, count($currency));
    }

    /** @test */
    public function testCurrencyByCurrencyCode()
    {
        // Arrange
        $currency = World::currencyByCountryCode('US');

        // Assert
        $this->assertEquals(1, count($currency));
    }

    /** @test */
    public function testTimezones()
    {
        // Arrange
        $timezones = World::timezones();

        // Assert
        $this->assertGreaterThan(100, count($timezones));
    }

    /** @test */
    public function testTimezoneRegions()
    {
        // Arrange
        $timezoneRegions = World::timezoneRegions();

        // Assert
        $this->assertGreaterThan(8, count($timezoneRegions));
    }

    /** @test */
    public function testTimezonesByRegion()
    {
        // Arrange
        $timezones = World::timezonesByRegion('Antarctica');

        // Assert
        $this->assertGreaterThan(5, count($timezones));
    }

    /** @test */
    public function testSearchTimezone()
    {
        // Arrange
        $timezones = World::searchTimezone('UTC');

        // Assert
        $this->assertGreaterThan(0, count($timezones));
    }

    /** @test */
    public function testIsoCodes()
    {
        // Arrange
        $isoCodes = World::isoCodes();

        // Assert
        $this->assertGreaterThan(100, count($isoCodes));
    }

    /** @test */
    public function testRegions()
    {
        // Arrange
        $regions = World::regions();

        // Assert
        $this->assertLessThan(11, count($regions));
    }

    /** @test */
    public function testSearchIsoCodes()
    {
        // Arrange
        $isoCodes = World::searchIsoCodes('91');

        // Assert
        $this->assertGreaterThan(1, count($isoCodes));
    }

    /** @test */
    public function testIsoInfoByCountryName()
    {
        // Arrange
        $isoInfoByCountryName = World::isoInfoByCountryName('India');

        // Assert
        $this->assertEquals(0, count($isoInfoByCountryName));
    }

    /** @test */
    public function testIsoInfoByCode()
    {
        // Arrange
        $isoInfoByCode = World::isoInfoByCode('IN');

        // Assert
        $this->assertEquals($isoInfoByCode->status(), 200);
    }

    /** @test */
    public function testIsoCodesByRegion()
    {
        // Arrange
        $isoCodesByRegion = World::isoCodesByRegion('Europe');

        // Assert
        $this->assertGreaterThan(0, count($isoCodesByRegion));
    }

    /** @test */
    public function testStates()
    {
        // Arrange
        $states = World::states();

        // Assert
        $this->assertGreaterThan(4000, count($states));
    }

    /** @test */
    public function testSearchStates()
    {
        // Arrange
        $states = World::searchStates('tel');

        // Assert
        $this->assertGreaterThan(5, count($states));
    }

    /** @test */
    public function testCountriesForStates()
    {
        // Arrange
        $countriesForStates = World::countriesForStates('UAE');

        // Assert
        $this->assertGreaterThan(200, count($countriesForStates));
    }

    /** @test */
    public function testGetStatesByCountry()
    {
        // Arrange
        $states = World::getStatesByCountry('Taiwan');

        // Assert
        $this->assertGreaterThan(25, count($states));
    }

    /** @test */
    public function testStdCodes()
    {
        // Arrange
        $stdCodes = World::stdCodes();

        // Assert
        $this->assertGreaterThan(200, count($stdCodes));
    }

    /** @test */
    public function testSearchStdCodes()
    {
        // Arrange
        $stdCodes = World::searchStdCodes('44');

        // Assert
        $this->assertLessThan(10, count($stdCodes));
    }

    /** @test */
    public function testStdCodeByCountryName()
    {
        // Arrange
        $stdCodeByCountryName = World::stdCodeByCountryName('Russia');

        // Assert
        $this->assertEquals(count($stdCodeByCountryName), 1);
    }

    /** @test */
    public function testStdCodeByCountryCode()
    {
        // Arrange
        $stdCodeByCountryCode = World::stdCodeByCountryCode('CH');

        // Assert
        $this->assertEquals(count($stdCodeByCountryCode), 1);
    }

    /** @test */
    public function testCities()
    {
        // Arrange
        $cities = World::cities();

        // Assert
        $this->assertGreaterThan(5000, count($cities));
    }

    /** @test */
    public function testSearchCities()
    {
        // Arrange
        $cities = World::searchCities('hy');

        // Assert
        $this->assertGreaterThan(15, count($cities));
    }

    /** @test */
    public function statesForCities()
    {
        // Arrange
        $statesForCities = World::statesForCities();

        // Assert
        $this->assertGreaterThan(4000, count($statesForCities));
    }

    /** @test */
    public function countriesForCities()
    {
        // Arrange
        $countriesForCities = World::countriesForCities();

        // Assert
        $this->assertGreaterThan(245, count($countriesForCities));
    }

    /** @test */
    public function getCitiesByStateName()
    {
        // Arrange
        $city = World::getCitiesByStateName('Karnataka');

        // Assert
        $this->assertGreaterThan(323, count($city));
    }

    /** @test */
    public function getCitiesByCountryName()
    {
        // Arrange
        $city = World::getCitiesByCountryName('China');

        // Assert
        $this->assertGreaterThan(1300, count($city));
    }

}