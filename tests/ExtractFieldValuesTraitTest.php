<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests;

use ArrayAccess;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use ReflectionMethod;
use WideFocus\Feed\Writer\Tests\TestDouble\ExtractorDouble;
use WideFocus\Feed\Writer\WriterFieldInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\ExtractFieldValuesTrait
 */
class ExtractFieldValuesTraitTest extends TestCase
{
    /**
     * @param array       $fields
     * @param ArrayAccess $item
     * @param array       $expectedValues
     *
     * @return void
     *
     * @dataProvider extractDataProvider
     *
     * @covers ::extractFieldValues
     */
    public function testExtract(array $fields, ArrayAccess $item, array $expectedValues)
    {
        $extractor = new ExtractorDouble();

        $method = new ReflectionMethod(
            ExtractorDouble::class,
            'extractFieldValues'
        );
        $method->setAccessible(true);

        $this->assertEquals(
            $expectedValues,
            $method->invoke($extractor, $item, ...$fields)
        );
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
                        $item,
                        'foo'
                    ),
                    $this->mockWriterField(
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
     * @param ArrayAccess $item
     * @param string      $value
     *
     * @return PHPUnit_Framework_MockObject_MockObject|WriterFieldInterface
     */
    protected function mockWriterField(
        ArrayAccess $item,
        string $value
    ) {
        $writerField = $this->createMock(WriterFieldInterface::class);

        $writerField
            ->expects($this->any())
            ->method('getValue')
            ->with($item)
            ->willReturn($value);

        return $writerField;
    }
}
