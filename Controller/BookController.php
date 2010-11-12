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
        
        return $this->renderChapter($service->getTOC());
    }
    
    /**
     * render a chapter
     *
     * @param Chapter $chapter 
     * @return Response
     */
    private function renderChapter(Chapter $chapter)
    {
        return $this->render($this->container->getParameter('madoqua.view.scripts.book.chapterread'), array(
                'chapter' => $chapter
            ));
        //render the chapter view script
    }
}
