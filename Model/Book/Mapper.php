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
        $this->parseChaptersInDirectory($chapter, $directory);
        
    }
    
    /**
     * parse all pages in directory
     *
     * @param Chapter $chapter 
     * @param string $directory 
     * @return Chapter
     */
    private function parsePagesInDirectory(Chapter $chapter, $directory)
    {
        $pageFinder = new Finder();
        $pageFinder
            ->in($directory)
            ->files()
            ->depth(0)
            ->name('*.markdown');
            //finder for the subdirs
        
        foreach($pageFinder as $file) {
            $newDirectory = $file->getPath() . DIRECTORY_SEPARATOR . $file->getFilename();
            $chapter->addPage($this->createPageFromFileInfo($file));
        }
        
        return $chapter;
    }
    
    /**
     * parse sub-chapters in a given chapter directory
     *
     * @param Chapter $chapter 
     * @param string $directory 
     * @return Chapter
     */
    private function parseChaptersInDirectory(Chapter $chapter, $directory)
    {
        $chapterFinder = new Finder();
        $chapterFinder
            ->in($directory)
            ->directories();
            //finder for the subdirs
        
        foreach($chapterFinder as $dir) {
            
            $newDirectory = $dir->getPath() . DIRECTORY_SEPARATOR . $dir->getFilename();
            //subdir to use as a chapter
            
            $chapter->addChapter(
                $this->parseChapterDir($this->createChapterFromDirectoryName($dir->getFilename()), 
                $newDirectory)
            );
            //parse on recursively
        }
        
        return $chapter;
    }
    
    /**
     * create page from FileInfo object
     *
     * @param FileInfo $fileInfo 
     * @return Page
     */
    private function createPageFromFileInfo(\SplFileInfo $fileInfo)
    {
        $page = new Page($this->getFilter());
        
        $page->setText(file_get_contents((string) $fileInfo));
        
        $matches = array();
        $found = preg_match('/#.*/', $page->getText(), $matches);
        if ($found === false) {
            $title = $file->getFilename();
        } else {
            $title = ltrim(array_shift($matches), '#');
        }
        $page->setTitle($title);
        // //parse title out of body text
        
        return $page;
        
    }
    
    /**
     * create chapter from directory name
     *
     * @param string $name 
     * @return Chapter
     */
    private function createChapterFromDirectoryName($name)
    {
        $chapter = new Chapter;
        
        $chapter->setName($name);
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