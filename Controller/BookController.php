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
     * full book
     *
     * @return Response
     */
    public function fullAction()
    {
        $service = $this->container->get('service.book');
        $book =  $service->getTOC();
        
        return $this->render($this->container->getParameter('madoqua.view.scripts.book.full'), array(
            'book' => $book
        ));
    }
    
    /**
     * chapter
     *
     * @param string $path 
     * @return Response
     */
    public function chapterAction($path)
    {
        $service = $this->container->get('service.book');
        
        $chapter = $service->getChapterFromPath($path);
        
        if ($chapter === false) {
            throw new NotFoundHttpException('Chapter not found "' . $path . '"');
        }
        
        return $this->renderChapter($chapter);
    }
    
    /**
     * page action
     *
     * @param string $path 
     * @return Response
     */
    public function pageAction($path)
    {
        $service = $this->container->get('service.book');
        $page = $service->getPageFromPath($path);
        
        if ($page === false) {
            throw new NotFoundHttpException('Page not found "' . $path . '"');
        }
        
        return $this->render($this->container->getParameter('madoqua.view.scripts.book.pageread'), array(
            'page' => $page
        ));
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
