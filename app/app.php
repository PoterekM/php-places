<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/places.php";

    session_start();

    if (empty($_SESSION['list_of_places'])) {
        $_SESSION['list_of_places'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/home", function() use ($app) {

        return $app['twig']->render('places.html.twig', array('places' => Place::getAll()));
    });


    $app->post("/places", function() use ($app) {
        $city = new Place($_POST['city'], $_POST['favorite_food'], $_POST['destination']);
        $city->save();
        return $app['twig']->render('new_place.html.twig', array('new_place' => $city));

    });

    $app->post("/delete_places", function() use ($app) {
        Place::deleteAll();
        return $app['twig']->render('delete.html.twig');


    });

    return $app;
?>
