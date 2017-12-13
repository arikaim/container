# Arikaim Container
Mini Dependency Injection Container

PSR-11 compatibility

# Installation
composer require arikaim/container

# Usage 

```php 

use Arikaim\Container\Container;

$container = new Container();

```

**Add service to container**

```php 

$container['service'] = function() {
    echo "Service example";
};

$container->add('service_add',function() {
    echo "Service add example";
});

```
**Add parameters** 

```php

$container['config'] = "Config value";

```

**Replace service**  

```php

$container->replace('service',function() {
     echo "Replace Service";
});

```

**Psr-11** compatibility implement the PSR-11 ContainerInterface

```php
$servcie = $container->get('service');

if ( $container->has('service') ) {
    echo "Service exists";
} else {
    echo "Service not found";
}
```