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

namespace SolidInvoice\InstallBundle\Exception;

use Exception;

class ApplicationInstalledException extends Exception
{
    public function __construct()
    {
        parent::__construct('installation.already_installed');
    }
}
