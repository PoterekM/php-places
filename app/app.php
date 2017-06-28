<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/places.php";
    //
    // session_start();
    // if (empty($_SESSION['city'])) {
    //     $_SESSION['city'] = array();
    // }

    $app = new Silex\Application();

    $app->get("/home", function() {
      return "<!DOCTYPE html>
      <html>
          <head>
              <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
              <meta charset='utf-8'>
              <title>Places!</title>
          </head>
          <body>
              <div class='container'>
                  <form action='/places'>
                      <div class='form-group'>
                          <label for='city'>What city have you been to?</label>
                          <input name='city' class='form-control' type='text'>
                      </div>
                      <div class='form-group'>
                          <label for='favorite_food'>What was the best food you tasted?</label>
                          <input name='favorite_food' class='form-control' type='text'>
                      </div>
                      <div class='form-group'>
                          <label for='destination'>What was your favorite destination?</label>
                          <input name='destination' class='form-control' type='text'>
                      </div>
                      <button type='submit' class='btn-success'>Submit!</button>
                  </form>
              </div>
          </body>
      </html>";

    });

    $app->get("/places", function () {
        $city = new Place($_GET['city'], $_GET['favorite_food'], $_GET['destination']);

            return "<h1>Wow look at where you went</h1>
            <p> ". $city->getCity() . "</p>
            <p> ". $city->getFood() .  "</p>
            <p> ". $city->getDestination() . "</p>";

    });

    return $app;
?>
