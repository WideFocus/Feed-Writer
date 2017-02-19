<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests\Field;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Field\WriterFieldFactory;
use WideFocus\Feed\Writer\Field\WriterFieldInterface;
use WideFocus\Filter\FilterInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Field\WriterFieldFactory
 */
class WriterFieldFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param string   $name
     * @param string   $label
     * @param callable $filter
     *
     * @return WriterFieldInterface
     *
     * @covers ::createField
     *
     * @dataProvider fieldDataProvider
     */
    public function testCreateField(string $name, string $label, callable $filter = null): WriterFieldInterface
    {
        $factory = new WriterFieldFactory();
        return $factory->createField($name, $label, $filter);
    }

    /**
     * @return array
     */
    public function fieldDataProvider(): array
    {
        return [
            [
                'name',
                'label'
            ],
            [
                'another_name',
                'another_label',
                $this->createMock(FilterInterface::class)
            ]
        ];
    }
}
