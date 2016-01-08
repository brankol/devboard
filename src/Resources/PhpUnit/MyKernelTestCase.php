<?php
namespace Resources\PhpUnit;

use Prophecy\Prophet;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Class MyKernelTestCase.
 */
class MyKernelTestCase extends KernelTestCase
{
    protected $container;
    protected $prophet;

    public function setUp()
    {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
    }

    /**
     * @param string $username
     */
    protected function logUserIn($username = 'visitor1')
    {
        $user = $this->getUserByUsername($username);

        $token = new UsernamePasswordToken($user, '', 'main_firewall', $user->getRoles());
        self::$kernel->getContainer()->get('security.token_storage')->setToken($token);
    }

    /**
     * @param $username
     *
     * @return mixed
     */
    private function getUserByUsername($username)
    {
        return $this->getEm()->getRepository('NullDevUserBundle:User')->findOneByUsername($username);
    }

    private function getEm()
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }

    /**
     * @return Prophet
     */
    protected function getProphet()
    {
        if (null === $this->prophet) {
            $this->prophet = new Prophet();
        }

        return $this->prophet;
    }
}
