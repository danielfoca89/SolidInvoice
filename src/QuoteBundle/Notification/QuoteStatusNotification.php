<?php

declare(strict_types=1);

/*
 * This file is part of SolidInvoice project.
 *
 * (c) Pierre du Plessis <open-source@solidworx.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SolidInvoice\QuoteBundle\Notification;

use SolidInvoice\NotificationBundle\Attribute\AsNotification;
use SolidInvoice\NotificationBundle\Notification\NotificationMessage;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\Notifier\Message\EmailMessage;
use Symfony\Component\Notifier\Recipient\EmailRecipientInterface;
use Twig\Environment;

#[AsNotification(name: self::EVENT)]
class QuoteStatusNotification extends NotificationMessage
{
    public const EVENT = 'quote_status_update';

    final public const HTML_TEMPLATE = '@SolidInvoiceQuote/Email/status_change.html.twig';

    final public const TEXT_TEMPLATE = '@SolidInvoiceQuote/Email/status_change.text.twig';

    public function getTextContent(Environment $twig): string
    {
        return $twig->render(self::TEXT_TEMPLATE, $this->getParameters());
    }

    public function getSubject(): string
    {
        return 'Quote Status Change';
    }

    public function asEmailMessage(EmailRecipientInterface $recipient, ?string $transport = null): EmailMessage
    {
        $message = parent::asEmailMessage($recipient, $transport);

        $email = $message->getMessage();

        if ($email instanceof NotificationEmail) {
            $email->textTemplate(self::TEXT_TEMPLATE);
            $email->htmlTemplate(self::HTML_TEMPLATE);
            $email->context($this->getParameters());
        }

        return $message;
    }
}
