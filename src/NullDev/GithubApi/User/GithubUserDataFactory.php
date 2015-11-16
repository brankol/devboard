<?php
namespace NullDev\GithubApi\User;

/**
 * Class GithubUserDataFactory.
 */
class GithubUserDataFactory
{
    /**
     * @param array $inputData
     *
     * @return GithubUserData
     */
    public function create(array $inputData)
    {
        $githubId  = null;
        $email     = null;
        $name      = null;
        $avatarUrl = null;

        if (array_key_exists('id', $inputData)) {
            $githubId = $inputData['id'];
        }
        if (array_key_exists('email', $inputData)) {
            $githubId = $inputData['email'];
        }
        if (array_key_exists('name', $inputData)) {
            $githubId = $inputData['name'];
        }
        if (array_key_exists('avatar_url', $inputData)) {
            $githubId = $inputData['avatar_url'];
        }
        $username = $inputData['login'];

        return new GithubUserData($githubId, $username, $email, $name, $avatarUrl);
    }
}
