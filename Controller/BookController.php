<?php
/**
 * BookController.php
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Controller
 */

namespace Application\MadoquaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Application\MadoquaBundle\Model\Book\Page;
use Application\MadoquaBundle\Model\Book\Chapter;

/**
 * BookController
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Controller
 */
class BookController extends Controller
{
    /**
     * show latest posts
     *
     * @return Response
     */
    public function indexAction()
    {
        $service = $this->container->get('service.book');
        
        var_dump($service->getTOC());
        
        die();
        return $this->createResponse('xxx');
    }
}
