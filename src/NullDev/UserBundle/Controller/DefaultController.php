<?php
namespace NullDev\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController.
 */
class DefaultController extends Controller
{
    /**
     * @param $name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($name)
    {
        return $this->render('NullDevUserBundle:Default:index.html.twig', ['name' => $name]);
    }
}
