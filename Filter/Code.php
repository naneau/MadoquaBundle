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
     * regex to match <pre><code>#lang blocks
     *
     * @var string
     */
    private static $regex = '/\<pre\>\<code\>(\#[A-Za-z0-9_]+\n)(.*)\<\/code\>\<\/pre\>/sU';
    
    /**
     * filter
     *
     * @param string $text 
     * @return string
     */
    public function filter($text)
    {
        return preg_replace_callback(
            self::$regex,
            
            function($matches) {
                if (isset($matches[1]) && isset($matches[2])) {
                    //we have a #lang attribute in our <code />
                    
                    $language = trim($matches[1], "#\n");
                    $code = html_entity_decode(trim($matches[2], "\n"));
                    
                    $geshi = new \GeSHi($code, $language);
                    $geshi->set_header_type(GESHI_HEADER_PRE_VALID);
                    $geshi->set_overall_class('highlighted');
                    $geshi->enable_classes();
                    return $geshi->parse_code();
                    
                }
                
                return $matches[0]; //for some reason this went wrong
            },
            $text
        );
    }
}