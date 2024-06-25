<?php

/*
 * This file is part of SolidInvoice project.
 *
 * (c) Pierre du Plessis <open-source@solidworx.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SolidInvoice\DataGridBundle\GridBuilder\Formatter;

use SolidInvoice\DataGridBundle\GridBuilder\Column\Column;
use SolidInvoice\SettingsBundle\SystemConfig;
use Symfony\Component\Intl\Currencies;
use function is_string;

final class CurrencyFormatter implements FormatterInterface
{
    /**
     * @var string[]
     */
    private array $currencyList;

    public function __construct(
        private readonly SystemConfig $config,
        string $locale
    ) {
        $this->currencyList = Currencies::getNames($locale);
    }

    public function format(Column $column, mixed $value): string
    {
        if (! is_string($value)) {
            return $this->currencyList[$this->config->getCurrency()->getCode()];
        }

        return $this->currencyList[$value] ?? $this->currencyList[$this->config->getCurrency()->getCode()] ?? '';
    }
}
