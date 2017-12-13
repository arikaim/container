# Arikaim Container
Mini Dependency Injection Container

PSR-11 compatibility

# Installation
composer require arikaim/container

# Usage 

```php 
use Arikaim\Container\Container;

$container = new Container();

Add service to container 

$container['service'] = function() {
    echo "Service example";
};

or 

$container->add('service_add',function() {
    echo "Service add example";
});

add parameters 

$container['config'] = "Config value";

Psr-11   implement the PSR-11 ContainerInterface

$servcie = $container->get('service');

and 

if ( $container->has('service') ) {
    echo "Service exists";
} else {
    echo "Service not found";
}

```