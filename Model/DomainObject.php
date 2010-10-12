<?php
/**
 * DomainObject.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Model
 */

namespace Application\MadoquaBundle\Model;

/**
 * DomainObject
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Model
 */
class DomainObject
{
    /**
     * getter overload
     *
     * @param string $what 
     * @return mixed
     */
    public function __get($what)
    {
        $methodName = 'get' . ucfirst($what);
        
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        }
        
        throw new Exception($what . ' does not exist in object of class ' . get_class($this));
    }
    
    /**
     * setter
     *
     * @param string $what
     * @param mixed $value
     * @return void
     */
    public function __set($what, $value)
    {
        $methodName = 'set' . ucfirst($what);
        
        if (method_exists($this, $methodName)) {
            return $this->$methodName($value);
        }
        
        throw new Exception($what . ' does not exist in object of class ' . get_class($this));
    }
}