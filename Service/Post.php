<?php
/**
 * Post.php
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Service
 */

namespace Application\MadoquaBundle\Service;

use Application\MadoquaBundle\Model\Post\Post as PostDO;
use Application\MadoquaBundle\Model\Post\Mapper as Mapper;

/**
 * Post
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Service
 */
class Post
{
    /**
     * mapper for the posts
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
     * get blog post by identifier
     *
     * @string $identifier
     * @return PostDO;
     */
    public function getByIdentifier($identifier)
    {
        return $this->getMapper()->getByIdentifier($identifier);
    }
    
    /**
     * get latest posts
     *
     * @param int $count number of posts to fetch
     * @return array[int]PostDO
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