<?php

namespace Application\MadoquaBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper as Helper;

class Alternate extends Helper
{
    /**
     * counter
     *
     * @var int
     */
    private $count = 0;
    
    /**
     * Returns the canonical name of this helper.
     *
     * @return string The canonical name
     */
    public function getName()
    {
        return 'alternate';
    }
    
    /**
     * alternate between array values
     *
     * @param array[int]mixed $array 
     * @return mixed
     */
    public function alternate($array) {
        return $array[$this->count++ % count($array)];
    }
}
