<?php
/**
 * Mapper.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Model
 */

namespace Application\MadoquaBundle\Model\Book;

use Application\MadoquaBundle\Model\Book\Page as Page;
use Application\MadoquaBundle\Model\Book\Chapter as Chapter;

use Application\MadoquaBundle\Filter\Filter;
use Symfony\Component\Finder\Finder;
/**
 * Mapper
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Model
 */
class Mapper
{
    /**
     * directory the posts live in
     *
     * @var string
     */
    private $directory;
    
    /**
     * filter for the post text
     *
     * @var Filter
     */
    private $filter;
    
    /**
     * constructor
     *
     * @param string $directory 
     * @param Filter $filter;
     */
    public function __construct($directory, Filter $filter)
    {
        $this->setDirectory($directory);
        $this->setFilter($filter);
    }
    
    /**
     * get "root" chapter
     *
     * @return Chapter
     */
    public function getToc()
    {
        $chapter = new Chapter;
        return $this->parseChapterDir($chapter, $this->getDirectory());
        return $chapter;
    }
    
    /**
     * recursive chapter parser
     *
     * @param Chapter $chapter 
     * @param string $directory 
     * @return Chapter
     */
    public function parseChapterDir(Chapter $chapter, $directory)
    {
        echo $directory . ' ';
        $chapterFinder = new Finder();
        $chapterFinder
            ->in($directory)
            ->directories();
            //finder for the subdirs
        
        foreach($chapterFinder as $dir) {
            $newDirectory = $dir->getPath() . DIRECTORY_SEPARATOR . $dir->getFilename();
            $chapter->addChapter($this->parseChapterDir(new Chapter, $newDirectory));
        }
        
        $pageFinder = new Finder();
        $pageFinder
            ->in($directory)
            ->files()
            ->depth(0)
            ->name('*.markdown');
            //finder for the subdirs
        
        foreach($pageFinder as $file) {
            $newDirectory = $file->getPath() . DIRECTORY_SEPARATOR . $file->getFilename();
            $chapter->addPage(new Page);
        }
        
        
        return $chapter;
    }
    
    /**
     * get a finder instance for the proper directory
     *
     * @return Finder
     */
    private function createFinder()
    {
        $finder = new Finder();
        $finder->in($this->directory)
            ->sortByName()
            // ->name('*.markdown');
            ;
        return $finder;
    }
    
    /**
     * get directory the posts live in
     *
     * @return String
     */
    private function getDirectory()
    {
        return $this->directory;
    }
    
    /**
     * set directory the posts live in
     *
     * @param string $directory 
     * @return void
     */
    private function setDirectory($directory)
    {
        $this->directory = rtrim($directory, '/') . '/';
    }
    
    /**
     * get filter
     *
     * @return Filter
     */
    private function getFilter()
    {
        return $this->filter;
    }
    
    /**
     * set filter
     *
     * @param Filter $filter 
     * @return void
     */
    private function setFilter(Filter $filter)
    {
        $this->filter = $filter;
    }    
}