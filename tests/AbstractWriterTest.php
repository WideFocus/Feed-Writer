<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests;

use ArrayAccess;
use ArrayIterator;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\AbstractWriter;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\AbstractWriter
 */
class AbstractWriterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @covers ::write
     */
    public function testWrite()
    {
        $writer = $this->createWriter();

        $items = [
            $this->createMock(ArrayAccess::class),
            $this->createMock(ArrayAccess::class)
        ];

        $writer->expects($this->once())
            ->method('initialize');

        foreach ($items as $key => $item) {
            $writer->expects($this->at($key + 1))
                ->method('writeItem')
                ->with($item);
        }

        $writer->expects($this->once())
            ->method('finish');

        $writer->write(new ArrayIterator($items));
    }

    /**
     * @return AbstractWriter|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createWriter(): AbstractWriter
    {
        return $this->getMockForAbstractClass(
            AbstractWriter::class
        );
    }
}
