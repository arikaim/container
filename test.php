<?php

require_once "vendor/autoload.php";
require_once "container/Container.php";

use Arikaim\Container\Container;

$container = new Container();

$container['service'] = function() {
    echo "Service test";
};

//print_r($container);

$service = $container->get('service_1');

//var_dump($service);

$service();

?>