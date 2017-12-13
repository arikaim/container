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
 * 
 * @implements ContainerInterface, \ArrayAccess
 */
class Container implements ContainerInterface, \ArrayAccess 
{    
    private $services;

    /**
     * Container constructor
     *
     * @param array $services Container services 
     */
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
     * @param string $id Srvice id 
     * @throws ServiceNotFoundException;
     * @return mixed Service or null if not exist
     */
    public function get($id)
    {
        if ( $this->has($id) == true ) {
            return $this->services[$id];
        } 
        throw new ServiceNotFoundException($id);      
        return null; 
    }

    /**
     * Check if service exists in container PSR-11 ContainerInterface
     * 
     * @param string $id Service id
     * @return bool
     */
    public function has($id)
    {
        return isset($this->services[$id]);
    }

    /**
     * Add service to container
     *
     * @param string $id Service id 
     * @param mixed $service Service value 
     * @param boolean $replace Replace service if exists 
     * @throws ServiceExistsException If replace is false and  service exists in container
     * @return void
     */
    public function add($id, $service, $replace = false)
    {
        if ( ($this->has($id) == true) && ($replace == false) ) {           
            throw new ServiceExistsException($id);
        }
        $this->set($id,$service);
        return true;
    }

    /**
     * Replace service in container
     *
     * @param string $id Sservice id 
     * @param mixed $service Service value
     * @return void
     */
    public function replace($id,$service)
    {
        return $this->add($id,$service,true);
    }

    /**
     * Remove service from container
     *
     * @param string $id Service id
     * @return void
     */
    public function remove($id)
    {
        unset($this->services[$id]);
    }

    /**
     * Get array with all service id in container
     *
     * @return array
     */
    public function getServicesList()
    {
        return array_keys($this->services);
    }

    /**
     * ArrayAccess interface function
     *
     * @param string $id Service id
     * @return bool
     */
    public function offsetExists($id)
    {
        return  isset($this->services[$id]);
    }

    /**
     * ArrayAccess interface function
     *
     * @param string $id Service id
     * @return mixed
     */
    public function offsetGet($id)
    {
        return $this->has($id) ? $this->services[$id] : null;
    }

    /**
     * ArrayAccess interface function
     *
     * @param string $id Service id
     * @param mixed Service value
     * @return void
     */
    public function offsetSet($id, $service)
    {
        $this->services[$id] = $service;
    }

    /**
     * ArrayAccess interface function
     *
     * @param string $id Service id
     * @return void
     */
    public function offsetUnset($id)
    {
       $this->remove($id);
    }

    private function set($id, $service)
    {
        $this->services[$id] = $service;
    }
}
?>