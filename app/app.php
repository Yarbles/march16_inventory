<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../app/app.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $DB = new PDO('pgsql:host=localhost;dbname=inventory');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use($app) {
            return "Home";
    });

    return $app;

 ?>
