<?php
namespace NullDev\GithubApi\User;

/**
 * Interface GithubUserDataInterface.
 */
interface GithubUserDataInterface
{
    public function getUsername();

    public function getGithubId();

    public function getEmail();

    public function getName();

    public function getAvatarUrl();
}
