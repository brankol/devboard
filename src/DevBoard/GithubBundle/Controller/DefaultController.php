<?php
namespace DevBoard\GithubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DevBoardGithubBundle:Default:index.html.twig', ['name' => $name]);
    }
}
