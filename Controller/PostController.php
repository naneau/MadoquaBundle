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
        
        return $this->render('MadoquaBundle:Post:read', array('post' => $post));
    }
    
    /**
     * show latest posts
     *
     * @return Repsonse
     */
    public function latestAction()
    {
        $service = $this->container->get('model.post');
        $posts = $service->getLatest();
        
        return $this->render('MadoquaBundle:Post:latest', array('posts' => $posts));
    }
}
