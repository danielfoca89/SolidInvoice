<?php

/*
 * This file is part of SolidInvoice project.
 *
 * (c) Pierre du Plessis <open-source@solidworx.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SolidInvoice\DataGridBundle\Tests\GridBuilder\Filter;

use Doctrine\ORM\QueryBuilder;
use PHPUnit\Framework\TestCase;
use SolidInvoice\DataGridBundle\Form\Type\DateRangeFormType;
use SolidInvoice\DataGridBundle\GridBuilder\Filter\DateRangeFilter;

final class DateRangeFilterTest extends TestCase
{
    private DateRangeFilter $filter;

    private QueryBuilder $queryBuilder;

    protected function setUp(): void
    {
        $this->queryBuilder = $this->createMock(QueryBuilder::class);
        $this->filter = new DateRangeFilter('field');
    }

    public function formReturnsCorrectType(): void
    {
        $this->assertSame(DateRangeFormType::class, $this->filter->form());
    }

    public function filterAddsCorrectConditionsWhenStartAndEndArePresent(): void
    {
        $this->queryBuilder->expects($this->exactly(2))->method('andWhere');
        $this->queryBuilder->expects($this->exactly(2))->method('setParameter');

        $this->filter->filter($this->queryBuilder, ['start' => '2022-01-01', 'end' => '2022-01-31']);
    }

    public function filterAddsCorrectConditionWhenOnlyStartIsPresent(): void
    {
        $this->queryBuilder->expects($this->once())->method('andWhere');
        $this->queryBuilder->expects($this->once())->method('setParameter');

        $this->filter->filter($this->queryBuilder, ['start' => '2022-01-01']);
    }

    public function filterAddsCorrectConditionWhenOnlyEndIsPresent(): void
    {
        $this->queryBuilder->expects($this->once())->method('andWhere');
        $this->queryBuilder->expects($this->once())->method('setParameter');

        $this->filter->filter($this->queryBuilder, ['end' => '2022-01-31']);
    }

    public function filterDoesNotAddAnyConditionWhenStartAndEndAreNotPresent(): void
    {
        $this->queryBuilder->expects($this->never())->method('andWhere');
        $this->queryBuilder->expects($this->never())->method('setParameter');

        $this->filter->filter($this->queryBuilder, []);
    }
}