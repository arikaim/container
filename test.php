<?php

require_once "vendor/autoload.php";
require_once "container/Container.php";

use Arikaim\Container\Container;

$container = new Container();

$container['service'] = function() {
    echo "Service test";
};

$container->add("config","Config Value");


$service = $container->get('service');
$service();

$config = $container['config'];
echo $config;

 if ( $container->has('servie_2') == false) {
     echo "service_2 not exist";
 }

 unset( $container['config'] );
 $config = $container['config'];
 echo $config;
?>