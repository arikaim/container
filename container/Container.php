<?php
/**
 * Arikaim DI
 * Dependency injection container component
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c) Konstantin Atanasov <info@arikaim.com>
 * @license     MIT License
 */

namespace Arikaim\Cotainer;

use Arikaim\Cotainer\ServiceNotFoundException;
use Arikaim\Cotainer\ServiceExistsException;
use Psr\Container\ContainerInterface;


/**
 * Dependency injection container.
 */
class Container implements ContainerInterface, \ArrayAccess 
{    
    private $services;

    public function __construct(array $services = null)
    {        
        if ( is_array($this->services) == true ) {
            $this->services = $services;
        } else {
            $this->services = [];  
        }
    }

    /**
     * Get service from container
     *
     * @param [string] $id - srvice id 
     * @return mixed service or null if not exist
     * @throws ServiceNotFoundException;
     */
    public function get($id)
    {
        if ( $this->has($id) == true ) {
            return $this->services[$id];
        } 
        throw new ServiceNotFoundException($id);      
        return null; 
    }

    public function has($id)
    {
        return isset($this->services[$id]);
    }

    public function addService($id, $service, $replace = false)
    {
        if ( ($this->has($id) == true) && ($replace == false) ) {           
            throw new ServiceExistsException($id);
        }
        $this->set($id,$service);
        return true;
    }

    public function replaceService($id,$service)
    {
        return $this->addService($id,$service,true);
    }

    private function set($id, $service)
    {
        $this->service[$id] = $service;
    }

    public function remove($id)
    {
        unset($this->services[$id]);
    }

    public function offsetExists(mixed $id)
    {
        return $this->has($id);
    }

    public function offsetGet(mixed $id)
    {
        return $this->get($id);
    }

    public function offsetSet(mixed $id, mixed $value)
    {
        $this->set($id,$value);
    }

    public function offsetUnset(mixed $id)
    {
       $this->remove($id);
    }
}
?>