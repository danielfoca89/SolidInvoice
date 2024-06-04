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

// !! This file is autogenerated. Do not edit. !!

namespace SolidInvoice\NotificationBundle\Configurator;

use SolidInvoice\NotificationBundle\Form\Type\Transport\SinchType;
use Symfony\Component\Notifier\Transport\Dsn;
use function sprintf;
use function urlencode;

/**
 * @codeCoverageIgnore
 */
final class SinchConfigurator implements ConfiguratorInterface
{
    public static function getName(): string
    {
        return 'Sinch';
    }

    public static function getType(): string
    {
        return 'texter';
    }

    public function getForm(): string
    {
        return SinchType::class;
    }

    /**
     * @param array{ account_id: string, auth_token: string, from: string } $config
     */
    public function configure(array $config): Dsn
    {
        return new Dsn(sprintf('sinch://%s:%s@default?from=%s', urlencode($config['account_id']), urlencode($config['auth_token']), urlencode($config['from'])));
    }
}