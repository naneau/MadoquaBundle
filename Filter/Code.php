<?php
/**
 * Code.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Filter
 */

namespace Application\MadoquaBundle\Filter;

require_once(__DIR__ . '/../vendor/geshi/geshi.php');

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
        $text = preg_replace_callback(
            '/\<code\>(\#[A-Za-z0-9_]+\n)(.*)\<\/code\>/sU', 
            function($matches){
                if (isset($matches[1]) && isset($matches[2])) {
                    //we have a #lang attribute in our <code />
                    $language = trim($matches[1], "#\n");
                    $code = trim($matches[2], "\n");
                    $geshi = new \GeSHi($code, $language);
                    
                    return $geshi->parse_code();
                }
                
                return $matches[0];
            },
            $text
        );
        
        return $text;
    }
}