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
 * @covers \WideFocus\Feed\Writer\AbstractWriter
 */
class AbstractWriterTest extends PHPUnit_Framework_TestCase
{
    use CommonMocksTrait;
    use IterationMockTrait;

    /**
     * @param WriterFieldInterface[] $fields
     * @param WriterLayoutInterface  $layout
     *
     * @return AbstractWriter
     *
     * @covers \WideFocus\Feed\Writer\AbstractWriter::__construct
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
     * @covers \WideFocus\Feed\Writer\AbstractWriter::write
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
