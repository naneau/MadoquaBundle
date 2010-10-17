<?php
/**
 * PostController.php
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Controller
 */

namespace Application\MadoquaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * PostController
 *
 * @category        Application
 * @package         Madoqua
 * @subpackage      Controller
 */
class PostController extends Controller
{
    /**
     * read a post
     *
     * @param string $identifier 
     * @return Response
     */
    public function readAction($identifier)
    {
        $service = $this->container->get('model.post');
        $post = $service->getByIdentifier($identifier);
        if ($post === false) {
            throw new NotFoundHttpException('Post not found "' . $identifier . '"');
        }
        return $this->render('MadoquaBundle:Post:read', array('post' => $post));
    }

    /**
     * show latest posts
     *
     * @return Repsonse
     */
    public function indexAction()
    {
        $service = $this->container->get('model.post');
        $posts = $service->getLatest(1);
        if (count($posts) == 0) {
            throw new NotFoundHttpException('Can\'t show index without at least one post');
        }
        return $this->render('MadoquaBundle:Post:read', array('post' => array_pop($posts)));
    }
    
    /**
     * show latest posts
     *
     * @return Repsonse
     */
    public function latestAction($count = 5)
    {
        $service = $this->container->get('model.post');
        $posts = $service->getLatest($count);
        
        if (count($posts) == 0) {
            throw new NotFoundHttpException('No posts to display');
        }
        
        return $this->render('MadoquaBundle:Post:latest', array('posts' => $posts));
    }
}
