<?php
/**
 * Arikaim DI
 * Dependency injection container component
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c) Konstantin Atanasov <info@arikaim.com>
 * @license     MIT License
 */

namespace Arikaim\Container;


use Psr\Container\NotFoundExceptionInterface;


/**
 * Service not found in container exception
 */
class ServiceNotFoundException extends \InvalidArgumentException implements NotFoundExceptionInterface
{    
    public function __construct($id, $code = 0, \Exception $previous = null) {    
        parent::__construct("Service $id is not exists.", $code, $previous);
    }
}
?>