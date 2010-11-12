<?php
/**
 * Chapter.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Model
 */

namespace Application\MadoquaBundle\Model;

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
     * pages in this chapter
     *
     * @var array[int]Page
     */
    private $pages;
    
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
}