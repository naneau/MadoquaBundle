<?php
/**
 * FilterChain.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Filter
 */

namespace Application\MadoquaBundle\Filter;

use Application\MadoquaBundle\Filter\Filter;

/**
 * FilterChain
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Filter
 */
class FilterChain implements Filter
{
    /**
     * filter array
     *
     * @var array[int]Filter
     */
    private $filters = array();
    
    /**
     * constructor
     */
    public function __construct()
    {
        $filters = func_get_args();
        foreach($filters as $filter) {
            $this->addFilter($filter);
        }
    }
    
    /**
     * add a filter
     *
     * @param Filter $filter 
     * @return void
     */
    public function addFilter(Filter $filter)
    {
        $this->filters[] = $filter;
    }
    
    /**
     * filter
     *
     * @param string $text
     * @return string
     */
    public function filter($text)
    {
        foreach($this->filters as $filter) {
            $text = $filter->filter($text);
        }
        return $filter;
    }
}