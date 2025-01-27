<?php

/*
 * This file is part of SolidInvoice project.
 *
 * (c) Pierre du Plessis <open-source@solidworx.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SolidInvoice\DataGridBundle\Tests\GridBuilder\Formatter;

use Mockery as M;
use Money\Currency;
use PHPUnit\Framework\TestCase;
use SolidInvoice\DataGridBundle\GridBuilder\Column\CurrencyColumn;
use SolidInvoice\DataGridBundle\GridBuilder\Formatter\CurrencyFormatter;
use SolidInvoice\SettingsBundle\SystemConfig;

/**
 * @covers \SolidInvoice\DataGridBundle\GridBuilder\Formatter\CurrencyFormatter
 */
final class CurrencyFormatterTest extends TestCase
{
    use M\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function testFormat(): void
    {
        $config = M::mock(SystemConfig::class);
        $config->expects()
            ->getCurrency()
            ->andReturn(new Currency('USD'))
            ->times(4);

        $formatter = new CurrencyFormatter($config, 'en_US');

        self::assertSame('US Dollar', $formatter->format(CurrencyColumn::new('currency'), 'USD'));
        self::assertSame('Euro', $formatter->format(CurrencyColumn::new('currency'), 'EUR'));

        $formatter = new CurrencyFormatter($config, 'fr_FR');

        self::assertSame('dollar des États-Unis', $formatter->format(CurrencyColumn::new('currency'), 'USD'));
        self::assertSame('euro', $formatter->format(CurrencyColumn::new('currency'), 'EUR'));
    }
}
