<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTests extends PHPUnit_Framework_TestCase
    {

          protected function tearDown()
          {
              Restaurant::deleteAll();
              Cuisine::delteAll();
          }

          function test_getName()
          {
              //Arrange
              $name = "";
              $test_
          }
    }

?>
