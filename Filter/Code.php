<?php
/**
 * Code.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Filter
 */

namespace Application\MadoquaBundle\Filter;

use Application\MadoquaBundle\Filter\Filter;

/**
 * Code
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Filter
 */
class Code implements Filter
{
    /**
     * filter
     *
     * @param string $text 
     * @return string
     */
    public function filter($text)
    {
        $text = preg_replace('/\<code\>\n*\#(.*)/', '<code lang="$1">', $text);
        return $text;
    }
}