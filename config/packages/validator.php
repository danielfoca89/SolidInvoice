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

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Config\FrameworkConfig;

return static function (FrameworkConfig $config): void {
    $config
        ->validation()
        ->enabled(true)
        ->emailValidationMode(Email::VALIDATION_MODE_STRICT);
};
