<?php
/**
 * Arikaim DI
 * Dependency injection container component
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c) Konstantin Atanasov <info@arikaim.com>
 * @license     MIT License
 */

namespace Arikaim\Container;


use Arikaim\Container\ServiceNotFoundException;
use Arikaim\Container\ServiceExistsException;
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

    public function add($id, $service, $replace = false)
    {
        if ( ($this->has($id) == true) && ($replace == false) ) {           
            throw new ServiceExistsException($id);
        }
        $this->set($id,$service);
        return true;
    }

    public function replace($id,$service)
    {
        return $this->add($id,$service,true);
    }

    private function set($id, $service)
    {
        $this->services[$id] = $service;
    }

    public function remove($id)
    {
        unset($this->services[$id]);
    }

    public function getServicesList()
    {
        return array_keys($this->services);
    }

    public function offsetExists($id)
    {
        return  isset($this->services[$id]);
    }

    public function offsetGet($id)
    {
        return $this->has($id) ? $this->services[$id] : null;
    }

    public function offsetSet($id, $service)
    {
        $this->services[$id] = $service;
    }

    public function offsetUnset($id)
    {
       $this->remove($id);
    }
}
?>