<?php
declare(strict_types=1);

//include all requirements to connect to database
require_once('vendor\autoload.php');

//include all your model files here
require 'Model/DatabaseLoader.php';
require 'Model/Product.php';
require 'Model/Customer.php';
require 'Model/CustomerGroup.php';

//include all your controllers here
require 'Controller/HomepageController.php';
require 'Controller/InfoController.php';





//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!

$controller = new HomepageController();
if(isset($_GET['page']) && $_GET['page'] === 'info') {
    $controller = new InfoController();
}

$controller->render($_GET, $_POST);


