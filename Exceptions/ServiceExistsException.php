<?php
/**
 *  Arikaim DI
 *  Dependency injection container component
 *  @link        http://www.arikaim.com
 *  @copyright   Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license     MIT License
 */
namespace Arikaim\Container\Exceptions;

use Psr\Container\ContainerExceptionInterface;

/**
 * Service exists in container exception
 * 
 * @implements ContainerExceptionInterface
 */
class ServiceExistsException extends \InvalidArgumentException implements ContainerExceptionInterface
{    
    public function __construct($id, $code = 0, \Exception $previous = null) {    
        parent::__construct("Service $id exists. Use replace function.", $code, $previous);
    }
}