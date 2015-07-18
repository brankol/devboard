<?php
namespace NullDev\GithubApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NullDevGithubApiBundle:Default:index.html.twig', ['name' => $name]);
    }
}
