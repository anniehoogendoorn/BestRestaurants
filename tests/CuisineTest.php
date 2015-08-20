<?php

    /**
    * @backupGlobals disabled
    * @backupAtrributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=best_restaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();

        }

        function test_getName()
        {

            //Arrange
            $name = "Italian";
            $test_cuisine = new Cuisine($name);

            //Act
            $result = $test_cuisine->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {

            //Arrange
            $name = "Italian";
            $id = 1;
            $test_cuisine = new Cuisine($name, $id);

            //Act
            $result = $test_cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));

        }

        function test_save()
        {

            //Arrange
            $name = "Italian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_cuisine, $result[0]);

        }

        function test_getAll()
        {

            //Arrange
            $name = "Italian";
            $name2 = "French";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function testGetRestaurants()
        {

            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();

            $name = "Piazza Italia";
            $test_restaurant = new Restaurant($name, $id, $test_cuisine_id, $rating);
            $test_restaurant->save();

            $name2 = "Ristotante Roma";
            $test_restaurant2 = new Restaurant($name, $id, $test_cuisine_id, $rating);
            $test_restaurant2->save();

            //Act
            $result = $test_cuisine->getRestaurants();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);

        }

        function testUpdate()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $new_name = "Greek";

            //Act
            $test_cuisine->update($new_name);

            //Assert
            $this->assertEquals("Greek", $test_cuisine->getName());
        }

        function testDelete()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name2 = "French";
            $test_cuisine2 = new Cuisine($name2, $id);
            $test_cuisine2->save();

            //Act
            $test_cuisine->delete();

            //Assert
            $this->assertEquals([$test_cuisine2], Cuisine::getAll());
        }

        function testDeleteCuisineRestaurants()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Piazza Italia";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $rating);
            $test_restaurant->save();

            //Act
            $test_cuisine->delete();

            //Assert
            $this->assertEquals([], Restaurant::getAll());

        }


    }

?>
