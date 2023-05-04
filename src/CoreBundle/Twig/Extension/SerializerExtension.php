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

namespace SolidInvoice\CoreBundle\Twig\Extension;

use Symfony\Component\Serializer\SerializerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * @codeCoverageIgnore
 */
class SerializerExtension extends AbstractExtension
{
    public function __construct(
        private readonly SerializerInterface $serializer
    ) {
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('serialize', fn ($data, string $format, array $groups = []) => $this->serializer->serialize($data, $format, ['groups' => $groups])),
        ];
    }
}
