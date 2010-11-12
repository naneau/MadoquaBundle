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
     * files to ignore
     */
    private static $ignoredFiles = array('README.markdown');
    
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
     * @param string $directory directory the book lives in
     * @param Filter $filter filter for the Page content
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
        $chapter->setName('Table Of Contents');
        $chapter->setPath('toc');
        //simple chapter model
        
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
        $this->parsePagesInDirectory($chapter, $directory);
        
        return $chapter;
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
            if (in_array($file->getFilename(), self::$ignoredFiles)) {
                continue;
            }
            
            $newDirectory = $file->getPathname();
            $chapter->addPage($this->createPageFromFileInfo($file));
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
        $page->setTitle($this->stripNumberFromString($title));
        // //parse title out of body text
        
        $page->setPath(
            $this->parsePath($fileInfo)
        );
        //set "path" like identifier
        
        return $page;
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
            ->depth(0)
            ->directories();
            //finder for the subdirs
        
        foreach($chapterFinder as $dir) {
            
            $newDirectory = $dir->getPathname();
            //subdir to use as a chapter
            
            $chapter->addChapter(
                $this->parseChapterDir(
                    $this->createChapterFromFileInfo($dir), 
                    $newDirectory
                )
            );
            //parse on recursively
        }
        
        return $chapter;
    }

    /**
     * create chapter from directory name
     *
     * @param string $name 
     * @return Chapter
     */
    private function createChapterFromFileInfo(\SplFileInfo $fileInfo)
    {
        $chapter = new Chapter;
        
        $chapter->setName($this->stripNumberFromString($fileInfo->getFilename()));
        
        $chapter->setPath(
            $this->parsePath($fileInfo)
        );
        //set "path" like identifier
        
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
    
    /**
     * parse path from file info
     *
     * @param SplFileInfo $fileInfo 
     * @return string
     */
    private function parsePath(\SplFileInfo $fileInfo)
    {
        $path = trim(substr($fileInfo->getPathname() . DIRECTORY_SEPARATOR, strlen($this->getDirectory())), '/');
        //remove the part of the path that's the same as the base directory
        
        $path = $this->stripNumberFromString($path);
        //remove numbered part
        
        $path = str_replace('.markdown', '', $path);        
        //remove .markdown
        
        $path = str_replace(array(DIRECTORY_SEPARATOR, ' ', '.'), '-', $path);
        //replace some characters 
        //FIXME this needs to be done proplery
        
        return strtolower($path);
    }
    
    /**
     * split number part
     *
     * @param string $string 
     * @return void
     */
    private function stripNumberFromString($string)
    {
        $parts = explode('-', $string);
        if (is_numeric(trim($parts[0]))) {
            unset($parts[0]);
        }
        $string = implode('-', $parts);
        
        return trim($string, '- ');
    }
}