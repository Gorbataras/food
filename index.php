<?php
//CONTROLLER

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('vendor/autoload.php');

$f3 = Base::instance();

$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3 ->route('GET /breakfast', function (){
    $view = new Template();
    echo $view->render('views/breakfast.html');
});
$f3 ->route('GET /lunch', function (){
    $view = new Template();
    echo $view->render('views/lunch.html');
});

$f3->route('GET /order', function (){
    $view = new Template();
    echo $view->render('views/form1.html');
});

$f3->route('GET /@item',function ($f3, $params) {
//    var_dump($params);
    $item = $params['item'];
    echo "<p>You order $item</p>";
    $foodsWeServe = array("tacos","pizza","lumpia",);
    if (!in_array($item, $foodsWeServe)); {
        echo "<p>Sorry, we don't serve $item</p>";
    }

    switch ($item) {
        case 'tacos':
            echo "<P>We serve tacos on Tuesdays</p>";
            break;
        case 'pizza':
            echo "<p>Pepperoni or veggie</p>";
            break;
        case 'bagels':
            $f3->reroute("/breakfast");
        default:
            $f3->error(404);
    }
});


//Run
$f3->run();