<?php

namespace Arikaim\Cotainer;


use Interop\Container\ContainerInterface as InteropContainer;
use Psr\Container\ContainerInterface as Psr11Container;


/**
 * Dependency injection container.
 */
class Container implements InteropContainer
{    
    protected $services;

    public function __construct(array $services)
    {        
        if ( is_array($this->services) == true ) {
            $this->services = $services;
        }
    }

    public function get($id)
    {
        if ( isset($this->services[$id]) == true ) {
            return $this->services[$id];
        } else {
            throw new \Exception(sprintf('Service "%s" is not exists.', $id));
        }
    }

    public function has($id)
    {
        return isset($this->services[$id]);
    }

    public function addService($id, $service)
    {

    }
}
?>