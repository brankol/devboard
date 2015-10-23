<?php
namespace NullDev\UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as FOSRegistrationController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RegistrationController.
 */
class RegistrationController extends FOSRegistrationController
{
    /**
     * Overwriting registration url so users can not register on site!
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function registerAction(Request $request)
    {
        return $this->redirectToRoute('homepage', [], 301);
    }
}
