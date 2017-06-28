<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/places.php";

    session_start();
    if (empty($_SESSION['list_of_places'])) {
        $_SESSION['list_of_places'] = array();
    }

    $app = new Silex\Application();

    $app->get("/home", function() {
        $output = "";
        foreach (Place::getAll() as $city) {
            $output = $output . "<p>" . $city->getCity() . "</p>
            <p>" . $city->getFood() . "</p>
            <p>" . $city->getDestination() . "</p>";
        }

        $output = $output . "
            <form action='/places' method='post'>
                <label for='city'>What city have you been to?</label>
                <input name='city' class='form-control' type='text'>
                <label for='favorite_food'>What was the best food you tasted?</label>
                <input name='favorite_food' class='form-control' type='text'>
                <label for='destination'>What was your favorite destination?</label>
                <input name='destination' class='form-control' type='text'>
                <button type='submit' class='btn-success'>Submit!</button>
            </form>
        ";
        return $output;
    });

    //   return "<!DOCTYPE html>
    //   <html>
    //       <head>
    //           <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    //           <meta charset='utf-8'>
    //           <title>Places!</title>
    //       </head>
    //       <body>
    //           <div class='container'>
    //               <form action='/places'>
    //                   <div class='form-group'>
    //                       <label for='city'>What city have you been to?</label>
    //                       <input name='city' class='form-control' type='text'>
    //                   </div>
    //                   <div class='form-group'>
    //                       <label for='favorite_food'>What was the best food you tasted?</label>
    //                       <input name='favorite_food' class='form-control' type='text'>
    //                   </div>
    //                   <div class='form-group'>
    //                       <label for='destination'>What was your favorite destination?</label>
    //                       <input name='destination' class='form-control' type='text'>
    //                   </div>
    //                   <button type='submit' class='btn-success'>Submit!</button>
    //               </form>
    //           </div>
    //       </body>
    //   </html>";
    //
    // });

    $app->POST("/places", function () {
        $city = new Place($_POST['city'], $_POST['favorite_food'], $_POST['destination']);
        $city->save();
        return "<h1>Wow look at where you went</h1>
            <p> ". $city->getCity() . "</p>
            <p> ". $city->getFood() .  "</p>
            <p> ". $city->getDestination() . "</p>
        ";

    });

    return $app;
?>
