<?php
namespace NullDev\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NullDevUserBundle:Default:index.html.twig', ['name' => $name]);
    }
}
