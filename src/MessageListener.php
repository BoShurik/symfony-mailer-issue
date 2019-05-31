<?php
/**
 * User: boshurik
 * Date: 2019-05-31
 * Time: 19:52
 */

namespace App;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Event\MessageEvent;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Header\MailboxListHeader;
use Symfony\Component\Mime\Message;

class MessageListener implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $sender;

    public function __construct(string $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            MessageEvent::class => 'onMessage',
        ];
    }

    public function onMessage(MessageEvent $event)
    {
        $message = $event->getMessage();
        if (!$message instanceof Message) {
            return;
        }

        $message->getHeaders()->add(new MailboxListHeader('From', Address::createArray([$this->sender])));
    }
}