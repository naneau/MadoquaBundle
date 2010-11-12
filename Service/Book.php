<?php
/**
 * Book.php
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Service
 */

namespace Application\MadoquaBundle\Service;

use Application\MadoquaBundle\Model\Book\Page as Page;
use Application\MadoquaBundle\Model\Book\Chapter as Chapter;
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
     * get main "book" TOC
     *
     * @return Chapter
     */
    public function getTOC()
    {
        return $this->mapper->getToc();
    }
    
    /**
     * get chapter from "path" identifier
     *
     * @param string $path 
     * @return Chapter
     */
    public function getChapterFromPath($path)
    {
        $toc = $this->getTOC();
        
        return $this->findChapterFromPath($toc, $path);
    }
    
    /**
     * find chapter from path recursively
     *
     * @param Chapter $chapter 
     * @param string $path 
     * @return bool|Chapter
     */
    private function findChapterFromPath(Chapter $chapter, $path)
    {
        if ($chapter->getPath() == $path) {
            return $chapter;
        }
        
        foreach($chapter->getChapters() as $subChapter) {
            $found = $this->findChapterFromPath($subChapter, $path);
            if ($found !== false) {
                return $found;
            }
        }
        
        return false;
    }
    
    /**
     * get chapter from "path" identifier
     *
     * @param string $path 
     * @return Chapter
     */
    public function getPageFromPath($path)
    {
        $toc = $this->getTOC();
        
        return $this->findPageFromPath($toc, $path);
    }
    
    /**
     * find chapter from path recursively
     *
     * @param Chapter $chapter 
     * @param string $path 
     * @return bool|Chapter
     */
    private function findPageFromPath(Chapter $chapter, $path)
    {
        foreach($chapter->getPages() as $page) {
            if ($page->getPath() == $path) {
                return $page;
            }
        }
        
        foreach($chapter->getChapters() as $subChapter) {
            $found = $this->findPageFromPath($subChapter, $path);
            if ($found !== false) {
                return $found;
            }
        }
        
        return false;
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