<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests\WriterField;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Tests\CommonMocksTrait;
use WideFocus\Feed\Writer\WriterField\LabelExtractor;
use WideFocus\Feed\Writer\WriterField\WriterFieldInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\WriterField\LabelExtractor
 */
class LabelExtractorTest extends PHPUnit_Framework_TestCase
{
    use CommonMocksTrait;

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
                        $this->createWriterFieldMock(),
                        'Foo'
                    ),
                    $this->mockWriterField(
                        $this->createWriterFieldMock(),
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
