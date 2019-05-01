<?php
/**
 * Created by PhpStorm.
 * User: jrakk
 * Date: 4/8/2019
 * Time: 2:16 PM
 */

    // Start seesion
    session_start();
    // Turn on error reporting
    ini_set('display_error', 1);
    error_reporting(E_ALL);

    //require autoload file
    require_once ('vendor/autoload.php');

    // create an instance of the base class
    $f3 = Base::instance();

    // Turn on Fat-free error reporting
    $f3->set('DEBUG', 3);


    $f3->set('colors', array('pink', 'green', 'blue'));

    // define a default route
    $f3->route('GET /@pet', function($f3, $param)
    {
        $pet = $param['pet'];
        echo "<h1>$pet</h1>";

        switch ($pet)
        {
            case 'dog':
                echo "<h3>Woof</h3>";
                break;
            case 'chicken':
                echo "<h3>Cluck</h3>";
                break;
            case 'cat':
                echo "<h3>Meow</h3>";
                break;
            case 'horse':
                echo "<h3>Neigh</h3>";
                break;
            case 'cow':
                echo "<h3>Moo</h3>";
                break;
            default:
                $f3->error(404);
        }
    });

    $f3->route('GET /', function()
    {
        echo "<h1>My pets</h1>";
        echo "<a href='order'>Order a Pet</a>";
    });

    $f3->route('GET|POST /order', function()
    {
        $view = new Template();
        echo $view->render("views/form1.html");
    });

    $f3->route('POST|GET /order2', function()
    {
        $_SESSION['animal'] = $_POST['animal'];
        $view = new Template();
        echo $view->render("views/form2.html");
    });

    $f3->route('POST|GET /results', function()
    {
        $_SESSION['color'] = $_POST['color'];
        $view = new Template();
        echo $view->render("views/results.html");
    });

    // Run Fat-Free
    $f3->run();
