<?php
/**
 * Post.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Model
 */

namespace Application\MadoquaBundle\Model;

use Application\MadoquaBundle\Filter\Filter;

/**
 * Post
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Model
 */
class Post
{
    /**
     * title
     *
     * @var string
     */
    private $title;

    /**
     * unparsed text
     *
     * @var string
     */
    private $text;
    
    /**
     * parsed text
     *
     * @var string
     */
    private $parsedText;
    
    /**
     * text filter
     *
     * @var Filter
     */
    private $filter;
    
    /**
     * constructor
     *
     * @param Filter $filter 
     */
    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
    }
    
    /**
     * set text
     *
     * @param string $text 
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
    }
    
    /**
     * get unparsed text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    
    /**
     * get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * set the title
     *
     * @param string $title 
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * get parsed text
     *
     * @return string
     */
    public function getParsedText()
    {
        if (empty($this->parsedText)) {
            $this->parsedText = $this->parseText();
        }
        return $this->parsedText;
    }
    
    /**
     * parse text
     *
     * @return string
     */
    private function parseText()
    {
        return $this->filter->filter($this->getText());
    }
}