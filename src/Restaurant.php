<?php

    class Restaurant
    {

          private $name;
          private $id;
          private $cuisine_id;
          private $rating;

          function __construct($name, $id = null, $cuisine_id, $rating)
          {
              $this->name = $name;
              $this->id = $id;
              $this->cuisine_id = $cuisine_id;
              $this->rating = $rating;
          }

          function setName($new_name)
          {
              $this->name = (string) $new_name;
          }

          function getName()
          {
              return $this->name;
          }

          function getId()
          {
              return $this->id;
          }

          function getCuisineId()
          {
              return $this->cuisine_id;
          }

          function setRating($new_rating)
          {
              $this->rating = (int) $new_rating;
          }

          function getRating()
          {
              return $this->rating;
          }

          function save()
          {
              $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id, rating) VALUES ('{$this->getName()}', {$this->getCuisineId()}, {$this->getRating()});");
              $this->id = $GLOBALS['DB']->lastInsertId();
          }

          static function getAll()
          {
              $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
              $restaurants = array();
              foreach($returned_restaurants as $restaurant) {
                  $name = $restaurant['name'];
                  $id = $restaurant['id'];
                  $cuisine_id = $restaurant['cuisine_id'];
                  $rating = $restaurant['rating'];
                  $new_restaurant = new Restaurant($name, $id, $cuisine_id, $rating);
                  array_push($restaurants, $new_restaurant);
              }

              return $restaurants;
          }

          static function deleteAll()
          {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");

          }

          static function find($search_id)
          {
              $found_restaurant = null;
              $restaurants = Restaurant::getAll();
              foreach($restaurants as $restaurant) {
                  $restaurant_id = $restaurant->getId();
                  if ($restaurant_id == $search_id) {
                      $found_restaurant = $restaurant;
                  }
              }
              return $found_restaurant;
          }
    }

?>
