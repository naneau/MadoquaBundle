<?php
/**
 * ExceptionController.php
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Controller
 */
namespace Application\MadoquaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * ExceptionController
 *
 * @category        Application
 * @package         MadoquaBundle
 * @subpackage      Controller
 */
class ExceptionController extends Controller
{
    /**
     * handle an exception
     *
     * @param Exception $exception
     * @return void
     */
    public function handleAction($exception)
    {
        $response = $this->render('MadoquaBundle:Exception:handle', array('exception' => $exception));
        $response->setStatusCode($exception->getStatusCode());
        return $response;
    }
}