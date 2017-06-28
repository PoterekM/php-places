<?php
    class Place
    {
        private $city;
        private $favorite_food;
        private $destination;

        function __construct ($city, $favorite_food, $destination)
        {
            $this->city = $city;
            $this->food = $favorite_food;
            $this->destination = $destination;
        }


        function getCity()
        {
            return $this->city;
        }
        function getFood()
        {
            return $this->food;
        }
        function getDestination()
        {
            return $this->destination;
        }

        function setCity($new_city)
        {
            $this->city = $new_city;
        }

        function setFood($new_food)
        {
            $this->food = $new_food;
        }

        function setDestination($new_destination)
        {
            $this->destination = $new_destination;
        }

        function save()
        {
            array_push($_SESSION['list_of_places'], $this);
        }
        static function getAll()
        {
            return $_SESSION['list_of_places'];
        }
        static function deleteAll()
        {
            $_SESSION['list_of_places'] = array();
        }
    }
?>
