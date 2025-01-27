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

use SolidInvoice\NotificationBundle\Form\Type\Transport\LightSmsType;
use Symfony\Component\Notifier\Transport\Dsn;
use function sprintf;
use function urlencode;

/**
 * @codeCoverageIgnore
 */
final class LightSmsConfigurator implements ConfiguratorInterface
{
    public static function getName(): string
    {
        return 'LightSms';
    }

    public static function getType(): string
    {
        return 'texter';
    }

    public function getForm(): string
    {
        return LightSmsType::class;
    }

    /**
     * @param array{ login: string, token: string, phone: string } $config
     */
    public function configure(array $config): Dsn
    {
        return new Dsn(sprintf('lightsms://%s:%s@default?from=%s', urlencode($config['login']), urlencode($config['token']), urlencode($config['phone'])));
    }
}
