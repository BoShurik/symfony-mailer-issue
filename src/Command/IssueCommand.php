<?php
/**
 * User: boshurik
 * Date: 2019-05-31
 * Time: 19:34
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class IssueCommand extends Command
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @inheritDoc
     */
    public function __construct(MailerInterface $mailer)
    {
        parent::__construct(null);

        $this->mailer = $mailer;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this
            ->setName('app:issue')
        ;
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = new Email();
        $message
            //->from('dummy@example.com')
            ->to('to@example.com')
            ->subject('Hello world')
            ->text('Hello world')
        ;

        $this->mailer->send($message);
    }

}