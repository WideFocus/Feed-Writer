<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use WideFocus\Feed\Writer\Tests\TestDouble\ExtractorDouble;
use WideFocus\Feed\Writer\WriterFieldInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\ExtractFieldLabelsTrait
 */
class ExtractFieldLabelsTraitTest extends TestCase
{
    /**
     * @param array $fields
     * @param array $expectedLabels
     *
     * @return void
     *
     * @dataProvider extractDataProvider
     *
     * @covers ::extractFieldLabels
     */
    public function testExtract(array $fields, array $expectedLabels)
    {
        $extractor = new ExtractorDouble();

        $method = new ReflectionMethod(
            ExtractorDouble::class,
            'extractFieldLabels'
        );
        $method->setAccessible(true);

        $this->assertEquals(
            $expectedLabels,
            $method->invoke($extractor, ...$fields)
        );
    }

    /**
     * @return array
     */
    public function extractDataProvider(): array
    {
        return [
            'filled' => [
                [
                    $this->createConfiguredMock(
                        WriterFieldInterface::class,
                        ['getLabel' => 'Foo']
                    ),
                    $this->createConfiguredMock(
                        WriterFieldInterface::class,
                        ['getLabel' => 'Bar']
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
}
