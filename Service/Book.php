<?php
/**
 * Book.php
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Service
 */

namespace Application\MadoquaBundle\Service;

use Application\MadoquaBundle\Model\Book\Book as BookDO;
use Application\MadoquaBundle\Model\Book\Mapper;

/**
 * Book
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Service
 */
class Book
{
    /**
     * mapper for the books
     *
     * @var Mapper
     */
    private $mapper;

    /**
     * constructor
     *
     * @param Mapper $mapper 
     */
    public function __construct(Mapper $mapper)
    {
        $this->setMapper($mapper);
    }
    
    /**
     * get Book by identifier
     *
     * @string $identifier
     * @return BookDO;
     */
    public function getByIdentifier($identifier)
    {
        return $this->getMapper()->getByIdentifier($identifier);
    }
    
    /**
     * get latest Books
     *
     * @param int $count number of Books to fetch
     * @return array[int]BookDO
     */
    public function getLatest($count = 5)
    {
        return $this->getMapper()->getLatest($count);
    }
    
    /**
     * get mapper
     *
     * @return Mapper
     */
    private function getMapper()
    {
        return $this->mapper;
    }
    
    /**
     * set mapper
     *
     * @param Mapper $mapper 
     * @return void
     */
    public function setMapper(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * get cache instance
     *
     * @return Cache
     */
    private function getCache()
    {
        //we do need it :x
    }
}