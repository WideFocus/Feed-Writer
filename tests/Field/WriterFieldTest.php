<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests\Field;

use ArrayAccess;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Field\WriterField;
use WideFocus\Filter\ContextAwareFilterInterface;
use WideFocus\Filter\FilterInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Field\WriterField
 */
class WriterFieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param string   $name
     * @param string   $label
     * @param callable $filter
     *
     * @return WriterField
     *
     * @dataProvider constructorDataProvider
     *
     * @covers ::__construct
     */
    public function testConstructor(string $name, string $label, callable $filter = null): WriterField
    {
        return new WriterField($name, $label, $filter);
    }

    /**
     * @param string $name
     * @param string $label
     *
     * @return void
     *
     * @dataProvider constructorDataProvider
     *
     * @covers ::getName
     */
    public function testGetName(string $name, string $label)
    {
        $field = new WriterField($name, $label);
        $this->assertEquals($name, $field->getName());
    }

    /**
     * @param string $name
     * @param string $label
     *
     * @return void
     *
     * @dataProvider constructorDataProvider
     *
     * @covers ::getLabel
     */
    public function testGetLabel(string $name, string $label)
    {
        $field = new WriterField($name, $label);
        $this->assertEquals($label, $field->getLabel());
    }

    /**
     * @param string                                           $name
     * @param string                                           $label
     * @param callable|PHPUnit_Framework_MockObject_MockObject $filter
     *
     * @return void
     *
     * @dataProvider constructorDataProvider
     *
     * @covers ::getValue
     */
    public function testGetValue(string $name, string $label, callable $filter = null)
    {
        $field = new WriterField($name, $label, $filter);

        $value    = 'some_value';
        $filtered = 'some_filtered_value';
        $item     = $this->createMock(ArrayAccess::class);

        $item->expects($this->once())
            ->method('offsetExists')
            ->with($name)
            ->willReturn(true);

        $item->expects($this->once())
            ->method('offsetGet')
            ->with($name)
            ->willReturn($value);

        if ($filter !== null) {
            $filter->expects($this->once())
                ->method('setContext')
                ->with($item);

            $filter->expects($this->once())
                ->method('__invoke')
                ->with($value)
                ->willReturn($filtered);
        }

        $expected = $filter !== null
            ? $filtered
            : $value;

        $this->assertEquals($expected, $field->getValue($item));
    }

    /**
     * @return array
     */
    public function constructorDataProvider(): array
    {
        return [
            [
                'name',
                'label'
            ],
            [
                'another_name',
                'another_label',
                $this->createMock(ContextAwareFilterInterface::class)
            ]
        ];
    }
}
