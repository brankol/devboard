<?php
namespace NullDev\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use NullDev\UserBundle\Entity\User;

/**
 * Class LoadUserFixtures.
 */
class LoadUserFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $superAdmin = new User();
        $superAdmin->setUsername('superadmin');
        $superAdmin->setEmail('testing+superadmin@nulldevelopment.hr');
        $superAdmin->setPlainPassword('pass123');
        $superAdmin->setRoles(['ROLE_SUPERADMIN']);
        $superAdmin->setEnabled(true);

        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('testing+admin@nulldevelopment.hr');
        $userAdmin->setPlainPassword('pass123');
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setEnabled(true);

        $visitor1 = new User();
        $visitor1->setUsername('visitor1');
        $visitor1->setEmail('testing+visitor1@nulldevelopment.hr');
        $visitor1->setPlainPassword('pass123');
        $visitor1->setRoles(['ROLE_USER']);
        $visitor1->setEnabled(true);

        $disabledUser1 = new User();
        $disabledUser1->setUsername('disabledUser1');
        $disabledUser1->setEmail('testing+disabledUser1@nulldevelopment.hr');
        $disabledUser1->setPlainPassword('pass123');
        $disabledUser1->setRoles(['ROLE_USER']);
        $disabledUser1->setEnabled(false);

        $manager->persist($superAdmin);
        $manager->persist($userAdmin);
        $manager->persist($visitor1);
        $manager->persist($disabledUser1);
        $manager->flush();

        $this->addReference('user-superadmin', $superAdmin);
        $this->addReference('user-admin', $userAdmin);
        $this->addReference('user-visitor1', $visitor1);
        $this->addReference('user-disabledUser1', $disabledUser1);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
