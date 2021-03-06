<?php
/**
 * Chapter.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Model
 */

namespace Application\MadoquaBundle\Model\Book;

use Application\MadoquaBundle\Model\Book\Page as Page;

/**
 * Chapter
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Model
 */
class Chapter
{
    /**
     * name of the chapter
     *
     * @var string
     */
    private $name;
    
    /**
     * path from the root
     *
     * @var string
     */
    private $path;
    
    /**
     * parent chapter
     *
     * @var Chapter
     */
    private $parent;
    
    /**
     * introduction text
     *
     * @var string
     */
    private $introduction;
    
    /**
     * pages in this chapter
     *
     * @var array[int]Page
     */
    private $pages = array();
    
    /**
     * chapters
     *
     * @var array[int]Chapter
     */
    private $chapters = array();
    
    /**
     * get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * set name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * set path
     *
     * @param string $path
     * @return void
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
    
    /**
     * get parent chapter
     *
     * @return Chapter
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * set parent chapter
     *
     * @param Chapter $parent
     * @return void
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
    
    /**
     * do we have a parent?
     *
     * @return bool
     */
    public function hasParent()
    {
        return !empty($this->parent);
    }
    
    /**
     * get intro text
     *
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * set intro text
     *
     * @param string $intro
     * @return void
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
    }
    
    /**
     * get pages
     *
     * @return array[int]Page
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * set pages
     *
     * @param array[int]Page $pages
     * @return void
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }
    
    /**
     * add a single page
     *
     * @param Page $page 
     * @return void
     */
    public function addPage(Page $page)
    {
        $page->setChapter($this);
        
        $this->pages[] = $page;
    }
    
    /**
     * get chapters
     *
     * @return array[int]Chapter
     */
    public function getChapters()
    {
        return $this->chapters;
    }

    /**
     * set chapters
     *
     * @param array[int]Chapter $chapters
     * @return void
     */
    public function setChapters($chapters)
    {
        $this->chapters = $chapters;
    }
    
    /**
     * add a chapter
     *
     * @param Chapter $chapter 
     * @return void
     */
    public function addChapter(Chapter $chapter) 
    {
        $chapter->setParent($this);
        $this->chapters[] = $chapter;
    }
}