<?php
/**
 * Filter.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Filter
 */

namespace Application\MadoquaBundle\Filter;

/**
 * Filter
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Filter
 */
interface Filter
{
    /**
     * filter a string
     *
     * @param string $text 
     * @return void
     */
    public function filter($text);
}