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

use Symfony\Config\BabdevPagerfantaConfig;

return static function (BabdevPagerfantaConfig $config): void {
    $config->defaultView('twig');
    $config->defaultTwigTemplate('@SolidInvoiceDataGrid/pagination.html.twig');
};