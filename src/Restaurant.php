<?php

    class Restaurant
    {

          private $name;
          private $id;
          private $cuisine_id;

          function __construct($name, $id = null, $cuisine_id)
          {
              $this->name = $name;
              $this->id = $id;
              $this->cuisine_id = $cuisine_id;
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

          function save()
          {
              $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id) VALUES ('{$this->getName()}', {$this->getCuisineId()})");
              $this->id = $GLOBALS['DB']->lastInsertId();
          }
    }
