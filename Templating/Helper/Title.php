<?php
/**
 * Title.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Templating
 */

namespace Application\MadoquaBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper as Helper;

/**
 * Title, gets title for head
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Templating
 */
class Title extends Helper
{
    /**
     * the title
     *
     * @var string
     */
    private $title;
    
    /**
     * constructor
     *
     * @param string $title 
     */
    public function __construct($title)
    {
        $this->setTitle($title);
    }
    
    /**
     * Returns the canonical name of this helper.
     *
     * @return string The canonical name
     */
    public function getName()
    {
        return 'title';
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
}
