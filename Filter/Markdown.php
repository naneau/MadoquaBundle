<?php
/**
 * Markdown.php
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Filter
 */
namespace Application\MadoquaBundle\Filter;

use Application\MadoquaBundle\Filter\Filter as Filter;
use Bundle\MarkdownBundle\Parser\MarkdownParser;

/**
 * Markdown
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Filter
 */
class Markdown implements Filter
{
    /**
     * parser
     *
     * @var MarkdownParser
     */
    private $parser;
    
    /**
     * constructor
     *
     * @param MarkdownParser $parser 
     */
    public function __construct(MarkdownParser $parser)
    {
        $this->parser = $parser;
    }
    
    /**
     * filter
     *
     * @param string $text 
     * @return void
     */
    public function filter($text)
    {
        return $this->parser->transform($text);
    }
}