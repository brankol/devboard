<?php
namespace NullDev\UserBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;

/**
 * Class FOSUBUserProvider.
 */
class FOSUBUserProvider extends BaseClass
{
    /**
     * {@inheritdoc}
     */
    public function loadUserByoAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getUsername();

        $user = $this->userManager->findUserBy([$this->getProperty($response) => $username]);

        if (null === $user) {
            return $this->doRegistration($response);
        }

        //if user exists - go with the HWIOAuth way
        $user = parent::loadUserByOAuthUserResponse($response);

        $serviceName = $response->getResourceOwner()->getName();

        $setter = 'set'.ucfirst($serviceName).'AccessToken';

        //update access token
        // do not set access token due to security concerns
        $user->$setter($response->getAccessToken());

        return $user;
    }

    /**
     * @param $response
     *
     * @return \FOS\UserBundle\Model\UserInterface
     */
    protected function doRegistration($response)
    {
        $identifier  = $response->getUsername();
        $email       = $response->getEmail();
        $username    = $response->getNickname();
        $profileName = $response->getRealName();

        if (!empty($email)) {
            // Check that user with same e-mail doesn't already exist
            if (null !== $this->userManager->findUserBy(['email' => $email])) {
                throw new AccountNotLinkedException(
                    'E-mail is already connected to another account. Please login and press connect.'
                );
            }
        }

        // Check that this nickname is not already used, if is add timestamp at the end
        if (null !== $this->userManager->findUserBy(['username' => $username])) {
            $username .= time();
        }

        //when the user is registering.
        $service           = $response->getResourceOwner()->getName();
        $setter            = 'set'.ucfirst($service);
        $setterProfileName = $setter.'ProfileName';
        $setterUserName    = $setter.'UserName';
        $setterId          = $setter.'Id';
        $setterToken       = $setter.'AccessToken';

        // create new user here
        $user = $this->userManager->createUser();

        $user->$setterProfileName($profileName);
        $user->$setterUserName($username);
        $user->$setterId($identifier);

        $user->$setterToken($response->getAccessToken());

        //I have set all requested data with the user's username
        //modify here with relevant data
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword(uniqid());
        $user->setProfileName($profileName);
        $user->setEnabled(true);

        $this->userManager->updateUser($user);

        return $user;
    }
}
