<?php

/*
 * This file is part of SolidInvoice project.
 *
 * (c) Pierre du Plessis <open-source@solidworx.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SolidInvoice\DataGridBundle\GridBuilder\Action;

final class ViewAction extends Action
{
    /**
     * @param array<string, mixed> $parameters
     */
    public static function new(string $route, array $parameters = []): static
    {
        return (new self())
            ->route($route, $parameters)
            ->label('View')
            ->icon('eye');
    }
}
