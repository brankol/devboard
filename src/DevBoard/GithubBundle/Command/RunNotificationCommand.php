<?php
namespace DevBoard\GithubBundle\Command;

use DateTime;
use NullDev\Date\Week;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CurrentWeeklyStatsCommand.
 */
class RunNotificationCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('github:notification:run')
            ->setDescription('Run github notification')
            ->addArgument(
                'data',
                InputArgument::OPTIONAL,
                'Notification data'
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rawData = $input->getArgument('data');

        $data = json_decode($rawData, true);

        $logger = $this->getContainer()->get('monolog.logger.ghnotifictation');

        $hookFactory = $this->getContainer()->get('github.webhook.factory');

        $event = $hookFactory->createFromQueueNotification($data);

        $securityChecker = $this->getContainer()->get('github.webhook.security_checker');

        if (!$securityChecker->check($event)) {
            $logger->error('Signatures dont match!');
        } else {
            $logger->info('Data:'.var_export($event->getRawPayload(), true));

            $this->getContainer()->get('github.event.payload.factory')->create($event);

            $this->getContainer()->get('github.event.handler')->handle($event);
        }

        echo 'Done!';
    }
}
