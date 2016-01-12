<?php
namespace DevBoard\Core\CreateProject;

use DevBoard\Core\Project\Entity\Project;
use DevBoard\CoreBundle\Form\CreateProjectType;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class CreateFormContainerFactory.
 */
class CreateFormContainerFactory
{
    /** @var Form */
    private $formFactory;
    /** @var Router */
    private $router;

    /**
     * CreateFormContainer constructor.
     *
     * @param FormFactory $formFactory
     * @param Router      $router
     */
    public function __construct(FormFactory $formFactory, Router $router)
    {
        $this->formFactory = $formFactory;
        $this->router      = $router;
    }

    /**
     * @return CreateFormContainer
     */
    public function create()
    {
        $type    = CreateProjectType::class;
        $data    = new Project();
        $options = [
            'action' => $this->getActionUrl(),
            'method' => 'POST',
        ];

        $form = $this->formFactory->create($type, $data, $options);

        $form->add('submit', SubmitType::class, ['label' => 'Track']);

        return new CreateFormContainer($form);
    }

    /**
     * @return string
     */
    private function getActionUrl()
    {
        return $this->router->generate('project_create', [], UrlGeneratorInterface::ABSOLUTE_PATH);
    }
}
