<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests\Field;

use ArrayAccess;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Field\ValueExtractor;
use WideFocus\Feed\Writer\Field\WriterFieldInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Field\ValueExtractor
 */
class ValueExtractorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param array       $fields
     * @param ArrayAccess $item
     * @param array       $expectedLabels
     *
     * @return void
     *
     * @dataProvider extractDataProvider
     *
     * @covers ::extract
     */
    public function testExtract(array $fields, ArrayAccess $item, array $expectedLabels)
    {
        $extractor = new ValueExtractor();

        $this->assertEquals($expectedLabels, $extractor->extract($fields, $item));
    }

    /**
     * @return array
     */
    public function extractDataProvider(): array
    {
        $item = $this->createMock(ArrayAccess::class);
        return [
            'filled' => [
                [
                    $this->mockWriterField(
                        $this->createMock(WriterFieldInterface::class),
                        $item,
                        'foo'
                    ),
                    $this->mockWriterField(
                        $this->createMock(WriterFieldInterface::class),
                        $item,
                        'bar'
                    )
                ],
                $item,
                [
                    'foo',
                    'bar'
                ]
            ],
            'empty' => [
                [],
                $item,
                []
            ]
        ];
    }

    /**
     * @param WriterFieldInterface|PHPUnit_Framework_MockObject_MockObject $writerField
     * @param ArrayAccess                                                  $item
     * @param string                                                       $value
     *
     * @return WriterFieldInterface
     */
    protected function mockWriterField(
        WriterFieldInterface $writerField,
        ArrayAccess $item,
        string $value
    ): WriterFieldInterface {
        $writerField->expects($this->any())
            ->method('getValue')
            ->with($item)
            ->willReturn($value);

        return $writerField;
    }
}
