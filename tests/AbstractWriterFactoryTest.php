<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */
namespace WideFocus\Feed\Writer\Tests;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\AbstractWriterFactory;
use WideFocus\Feed\Writer\Tests\Stubs\WriterStub;
use WideFocus\Feed\Writer\WriterFieldInterface;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Feed\Writer\WriterLayoutInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\AbstractWriterFactory
 */
class AbstractWriterFactoryTest extends PHPUnit_Framework_TestCase
{
    use CommonMocksTrait;

    /**
     * @param WriterFieldInterface[] $fields
     * @param WriterLayoutInterface  $layout
     *
     * @return WriterInterface
     *
     * @covers ::createWriter
     *
     * @dataProvider writerDataProvider
     */
    public function testCreateWriter(array $fields, WriterLayoutInterface $layout): WriterInterface
    {
        $factory = $this->createFactory();
        $factory->expects($this->once())
            ->method('getWriterClassName')
            ->willReturn(WriterStub::class);

        return $factory->createWriter($fields, $layout);
    }

    /**
     * @return AbstractWriterFactory|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createFactory(): AbstractWriterFactory
    {
        return $this->getMockForAbstractClass(AbstractWriterFactory::class);
    }

    /**
     * @return array
     */
    public function writerDataProvider(): array
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
