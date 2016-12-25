<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\AbstractWriter;
use WideFocus\Feed\Writer\WriterFieldInterface;
use WideFocus\Feed\Writer\WriterLayoutInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\AbstractWriter
 */
class AbstractWriterTest extends PHPUnit_Framework_TestCase
{
    use CommonMocksTrait;
    use IterationMockTrait;
    use ProtectedMethodTrait;

    /**
     * @param WriterFieldInterface[] $fields
     * @param WriterLayoutInterface  $layout
     *
     * @return AbstractWriter
     *
     * @covers ::__construct()
     *
     * @dataProvider constructorDataProvider
     */
    public function testConstructor(array $fields, WriterLayoutInterface $layout): AbstractWriter
    {
        return $this->createWriter($fields, $layout);
    }

    /**
     * @param WriterFieldInterface[] $fields
     * @param WriterLayoutInterface  $layout
     *
     * @return void
     *
     * @covers ::setFields()
     * @covers ::getFields()
     *
     * @dataProvider constructorDataProvider
     */
    public function testGetSetFields(array $fields, WriterLayoutInterface $layout)
    {
        $writer = $this->createWriter($fields, $layout);
        $method = $this->getProtectedMethod(AbstractWriter::class, 'getFields');
        $this->assertSame($fields, $method->invoke($writer));
    }

    /**
     * @param WriterFieldInterface[] $fields
     * @param WriterLayoutInterface  $layout
     *
     * @return void
     *
     * @covers ::setLayout()
     * @covers ::getLayout()
     *
     * @dataProvider constructorDataProvider
     */
    public function testGetSetLayout(array $fields, WriterLayoutInterface $layout)
    {
        $writer = $this->createWriter($fields, $layout);
        $method = $this->getProtectedMethod(AbstractWriter::class, 'getLayout');
        $this->assertSame($layout, $method->invoke($writer));
    }

    /**
     * @param WriterFieldInterface[] $fields
     * @param WriterLayoutInterface  $layout
     *
     * @return void
     *
     * @covers ::write
     *
     * @dataProvider constructorDataProvider
     */
    public function testWrite(array $fields, WriterLayoutInterface $layout)
    {
        $writer = $this->createWriter($fields, $layout);

        $items = [
            $this->createFeedItemMock(),
            $this->createFeedItemMock()
        ];

        $iterator = $this->createIteratorMock();
        $this->mockIteration($iterator, $items);

        $writer->expects($this->once())
            ->method('initialize');

        foreach ($items as $key => $item) {
            $writer->expects($this->at($key + 1))
                ->method('writeItem')
                ->with($item);
        }

        $writer->expects($this->once())
            ->method('finish');

        $writer->write($iterator);
    }

    /**
     * @param WriterFieldInterface[] $fields
     * @param WriterLayoutInterface  $layout
     *
     * @return AbstractWriter|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createWriter(array $fields, WriterLayoutInterface $layout): AbstractWriter
    {
        return $this->getMockForAbstractClass(
            AbstractWriter::class,
            [$fields, $layout]
        );
    }

    /**
     * @return array
     */
    public function constructorDataProvider(): array
    {
        return [
            [
                [
                    $this->createWriterFieldMock()
                ],
                $this->createWriterLayoutMock()
            ]
        ];
    }
}
