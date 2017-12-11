<?php
/**
 * Arikaim DI
 * Dependency injection container component
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c) Konstantin Atanasov <info@arikaim.com>
 * @license     MIT License
 */

namespace Arikaim\Cotainer;


use Psr\Container\ContainerInterface;


/**
 * Dependency injection container.
 */
class Container implements ContainerInterface
{    
    private $services;

    public function __construct(array $services = null)
    {        
        if ( is_array($this->services) == true ) {
            $this->services = $services;
        }
    }

    public function get($id)
    {
        if ( $this->has($id) == true ) {
            return $this->services[$id];
        } 
        throw new \Exception(sprintf('Service "%s" is not exists.', $id));       
    }

    public function has($id)
    {
        return isset($this->services[$id]);
    }

    public function addService($id, $service)
    {
        if ( $this->has($id) == true ) {
            // service exists exception
        }
    }

    public function replaceService($id, $service)
    {
        $this->service[$id] = $service;
    }
}
?>