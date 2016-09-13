<?php
require_once('vendor/autoload.php');
require_once('App/Payment/Processor.php');
require_once('App/Core/View/View.php');
require_once('App/Core/Router/AbstractRouter.php');
require_once('App/Core/Router/Router.php');

$router = new Router();
$router->routeRequest();

