<?php

namespace Application\MadoquaBundle\Model\Post;

use Application\MadoquaBundle\Model\Post;
use Application\MadoquaBundle\Filter\Filter;
use Symfony\Component\Finder\Finder;

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
     * get a post by identifier
     *
     * @param string $identifier 
     * @return Post
     */
    public function getByIdentifier($identifier)
    {
        $filename = $identifier . '.markdown';
        
        $finder = $this->createFinder()
            ->name($filename)
            ;
        
        if (iterator_count($finder) == 0) {
            throw new \Exception('Post not found: "' . $identifier . '"');
        }
        
        foreach($finder as $file) {
        }
    }
    
    /**
     * get latest $count posts
     *
     * @param int $count 
     * @return array[int]Post
     */
    public function getLatest($count = 3) 
    {
        $finder = $this->createFinder()
            ->sort(function(\SplFileInfo $file1, \SplFileInfo $file2){
                return $file1->getCTime() < $file2->getCTime();
            });
            
        $posts = array();
        foreach($finder as $file) {
            if ($count-- == 0) {
                return $posts;
            }
            $posts[] = $this->createFileFromFileInfo($file);
        }
        return $posts;
    }
    
    /**
     * create file from SplFileInfo
     *
     * @param SplFileInfo $file 
     * @return Post
     */
    private function createFileFromFileInfo(\SplFileInfo $file)
    {
        $post = new Post($this->getFilter());
        $post->setText(file_get_contents((string) $file));
        
        $matches = array();
        
        $found = preg_match('/#.*/', $post->getText(), $matches);
        if ($found === false) {
            $title = $file->getFilename();
        } else {
            $title = array_shift($matches);
        }
        $post->setTitle($title);
        //parse title out of body text
        return $post;
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
     * get a finder instance for the proper directory
     *
     * @return Finder
     */
    private function createFinder()
    {
        $finder = new Finder();
        $finder->in($this->directory)
            ->name('*.markdown');
            
        return $finder;
    }
}