<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\WriterFieldFactory;
use WideFocus\Feed\Writer\WriterFieldInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\WriterFieldFactory
 */
class WriterFieldFactoryTest extends PHPUnit_Framework_TestCase
{
    use CommonMocksTrait;

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
                $this->createFilterMock()
            ]
        ];
    }
}
