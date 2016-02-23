<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Item.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/items", function() use ($app) {
        return $app['twig']->render('inventory.html.twig', array('items' => Item::getAll()));
    });

    $app->post("/items", function() use ($app) {
        $item = new Item($_POST['name'], $_POST['description'], $_POST['value_amount'], $_POST['currency_type'], $_POST['collectable_type']);
        $item->save();
        return $app['twig']->render('inventory.html.twig', array('items' => Item::getAll()));
    });

    $app->post("/delete_items", function() use ($app) {
        Item::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    return $app;
?>
