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

use Application\MadoquaBundle\Model\Post;

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
        //fetch post
        
        return $this->renderPost($post);
    }

    /**
     * show latest posts
     *
     * @return Response
     */
    public function indexAction()
    {
        $service = $this->container->get('model.post');
        $posts = $service->getLatest(1);
        if (count($posts) == 0) {
            throw new NotFoundHttpException('Can\'t show index without at least one post');
        }
        
        return $this->renderPost(array_pop($posts));
    }
    
    /**
     * render a post read
     *
     * @param Post $post 
     * @return Response
     */
    private function renderPost(Post $post)
    {
        $response = $this->createResponse();
        $response->setETag('post_' . $post->getIdentifier());
        $response->setLastModified($post->getModified());
        //response
        
        $request = $this->container->get('request');
        
        if ($response->isNotModified($request)) {
            return $response;
        }
        //only render on not modified
        
        return $this->render('MadoquaBundle:Post:read', array(
                'post' => $post
            ), $response);
        //render post:read
        
    }
    
    /**
     * show latest posts
     *
     * @return Response
     */
    public function latestAction($count = 5)
    {
        $service = $this->container->get('model.post');
        $posts = $service->getLatest($count);
        
        if (count($posts) == 0) {
            throw new NotFoundHttpException('No posts to display');
        }
        
        $modified = new \DateTime();
        $modified->setTimestamp(0);
        //hmmz :x
        
        foreach($posts as $post) {
            if ($post->getModified()->getTimestamp() > $modified->getTimestamp()) {
                $modified = $post->getModified();
            }
        }
        //find largest modified
        
        $response = $this->createResponse();
        $response->setETag('post_latest_' . $count);
        $response->setLastModified($modified);
        //response with ETag
        
        $request = $this->container->get('request');
        
        if ($response->isNotModified($request)) {
            return $response;
        }
        //only render on not modified
            
        return $this->render('MadoquaBundle:Post:latest', array(
                'posts' => $posts
            ), $response);
        //render response
    }
}
