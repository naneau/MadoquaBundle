<?php
/**
 * IndexController.php
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Controller
 */

namespace Application\MadoquaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * IndexController
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Controller
 */
class IndexController extends Controller
{
    /**
     * index of the index
     *
     * @return void
     */
    public function indexAction()
    {
        $service = $this->container->get('model.post');
        $post = $service->getLatest();
        // var_dump($post);
        return $this->render('MadoquaBundle:Index:index');
    }
}
