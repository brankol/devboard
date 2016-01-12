<?php
namespace DevBoard\Core\CreateProject;

use NullDev\GithubApi\Repo\GithubRepoDataInterface;
use Symfony\Component\Form\Form;

/**
 * Class CreateFormContainer.
 */
class CreateFormContainer
{
    /** @var Form */
    private $form;

    /**
     * CreateFormContainer constructor.
     *
     * @param Form $form
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * @param GithubRepoDataInterface $repo
     *
     * @return \Symfony\Component\Form\FormView
     */
    public function getNew(GithubRepoDataInterface $repo)
    {
        $form = clone $this->form;

        $form->get('projectName')->setData($repo->getFullName());

        return $form->createView();
    }
}
