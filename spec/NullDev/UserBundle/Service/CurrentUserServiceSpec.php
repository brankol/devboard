<?php
namespace spec\NullDev\UserBundle\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CurrentUserServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\UserBundle\Service\CurrentUserService');
    }

    /**
     * @param Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage $tokenStorage
     */
    public function let($tokenStorage)
    {
        $this->beConstructedWith($tokenStorage);
    }

    /**
     * @param Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
     * @param NullDev\UserBundle\Entity\User                                      $user
     */
    public function it_should_return_current_user($token, $user, $tokenStorage)
    {
        $tokenStorage->getToken()->willReturn($token);
        $token->getUser()->willReturn($user);

        $this->getUser()->shouldReturnAnInstanceOf('NullDev\UserBundle\Entity\User');
    }

    /**
     */
    public function it_should_throw_exception_if_no_token_found()
    {
        $this->shouldThrow('Exception')->duringGetUser();
    }

    /**
     * @param Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
     */
    public function it_should_throw_exception_if_no_user_found($token, $tokenStorage)
    {
        $tokenStorage->getToken()->willReturn($token);
        $token->getUser()->willReturn(null);
        $this->shouldThrow('Exception')->duringGetUser();
    }
}
