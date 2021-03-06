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
     * identifier
     *
     * @var string
     */
    private $identifier;
    
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
     * created time
     *
     * @var string
     */
    private $created;
    
    /**
     * last modified time
     *
     * @var string
     */
    private $modified;
    
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
     * get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * set identifier
     *
     * @param string $identifier
     * @return void
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
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
     * get created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }
    
    /**
     * set created
     *
     * @param string $created
     * @return void
     */
    public function setCreated($created)
    {
        $this->created = new \DateTime;
        $this->created->setTimestamp($created);
    }

    /**
     * get last modified time
     *
     * @return string
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * set last modified time
     *
     * @param string $modified
     * @return void
     */
    public function setModified($modified)
    {
        $this->modified = new \DateTime();
        $this->modified->setTimestamp($modified);
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
     * get intro
     *
     * @return string
     */
    public function getIntro()
    {
        $matches = array();
        if (preg_match('/\<p\>(.*)\<\/p\>/sU', $this->getParsedText(), $matches) > 0) {
            if (!empty($matches[1])) {
                return $matches[1];                
            }
        }
        
        return $this->getText();
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