<?php
namespace DevBoard\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DevBoardCoreBundle:Default:index.html.twig', ['name' => $name]);
    }
}
