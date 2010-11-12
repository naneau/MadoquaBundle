<?php
/**
 * Page.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Model
 */

namespace Application\MadoquaBundle\Model\Book;

use Application\MadoquaBundle\Filter\Filter;

/**
 * Page
 * 
 * a single page in a book
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Model
 */
class Page
{
    /**
     * title
     *
     * @var string
     */
    private $title;
    
    /**
     * text
     *
     * @var string
     */
    private $text;
    
    /**
     * filter for the text
     *
     * @var Filter
     */
    private $filter;
    
    /**
     * obj. cache for parsed text
     *
     * @var string
     */
    private $parsedText;
    
    /**
     * constructor
     *
     * @param Filter $filter 
     */
    public function __construct(Filter $filter)
    {
        $this->setFilter($filter);
    }
    
    /**
     * get filter
     *
     * @return Filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * set filter
     *
     * @param Filter $filter
     * @return void
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
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
     * set title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
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
     * get parsed text (in html)
     *
     * @return string
     */
    public function getParsedText()
    {
        if (empty($this->parsedText)) {
            $this->parsedText = $this->getFilter()->filter($this->getText());
        }
        return $this->parsedText;
    }
}