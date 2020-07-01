<?php
/**
 * Created by PhpStorm.
 * User: babi
 * Date: 13/6/20
 * Time: 11:35 PM
 */

namespace Tests;


use Someshwer\WorldCountries\Facades\World;

class TestUtilities extends TestCase
{

    /** @test */
    public function testContinents()
    {
        // Arrange
        $continents = World::continents();

        // Assert
        $this->assertEquals(count($continents['continents']), 7);
    }

    /** @test */
    public function testOceans()
    {
        // Arrange
        $oceans = World::oceans();

        // Assert
        $this->assertEquals(count($oceans['oceans']), 5);
    }

    /** @test */
    public function testUnionTerritories()
    {
        // Arrange
        $unionTerritories = World::unionTerritories();

        // Assert
        $this->assertEquals(count($unionTerritories['union_territories']['india']), 7);
    }

    /** @test */
    public function testWonders()
    {
        // Arrange
        $wonders = World::wonders();

        // Assert
        $this->assertEquals(count($wonders['wonders_of_the_world']), 7);
    }

}