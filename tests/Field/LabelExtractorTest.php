<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests\Field;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Field\LabelExtractor;
use WideFocus\Feed\Writer\Field\WriterFieldInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\Field\LabelExtractor
 */
class LabelExtractorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param array $fields
     * @param array $expectedLabels
     *
     * @return void
     *
     * @dataProvider extractDataProvider
     *
     * @covers ::extract
     */
    public function testExtract(array $fields, array $expectedLabels)
    {
        $extractor = new LabelExtractor();
        $this->assertEquals($expectedLabels, $extractor->extract($fields));
    }

    /**
     * @return array
     */
    public function extractDataProvider(): array
    {
        return [
            'filled' => [
                [
                    $this->mockWriterField(
                        $this->createMock(WriterFieldInterface::class),
                        'Foo'
                    ),
                    $this->mockWriterField(
                        $this->createMock(WriterFieldInterface::class),
                        'Bar'
                    )
                ],
                [
                    'Foo',
                    'Bar'
                ]
            ],
            'empty' => [
                [],
                []
            ]
        ];
    }

    /**
     * @param WriterFieldInterface|PHPUnit_Framework_MockObject_MockObject $writerField
     * @param string                                                       $label
     *
     * @return WriterFieldInterface
     */
    protected function mockWriterField(
        WriterFieldInterface $writerField,
        string $label
    ): WriterFieldInterface {
        $writerField->expects($this->any())
            ->method('getLabel')
            ->willReturn($label);

        return $writerField;
    }
}
