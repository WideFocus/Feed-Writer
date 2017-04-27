<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests;

use ArrayAccess;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use WideFocus\Feed\Writer\WriterField;
use WideFocus\Filter\ContextAwareFilterInterface;
use WideFocus\Filter\FilterInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\WriterField
 */
class WriterFieldTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            WriterField::class,
            new WriterField('foo', 'bar')
        );
    }

    /**
     * @param string $name
     * @param string $label
     *
     * @return void
     *
     * @dataProvider dataProvider
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
     * @dataProvider dataProvider
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
     * @dataProvider dataProvider
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

        if ($filter instanceof ContextAwareFilterInterface) {
            $filter->expects($this->once())
                ->method('setContext')
                ->with($item);
        }

        if ($filter !== null) {
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
    public function dataProvider(): array
    {
        return [
            [
                'foo_name',
                'foo_label'
            ],
            [
                'bar_name',
                'bar_label',
                $this->createMock(FilterInterface::class)
            ],
            [
                'baz_name',
                'baz_label',
                $this->createMock(ContextAwareFilterInterface::class)
            ]
        ];
    }
}
