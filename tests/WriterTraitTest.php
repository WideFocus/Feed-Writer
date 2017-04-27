<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests;

use ArrayAccess;
use ArrayIterator;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Feed\Writer\WriterTrait;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\WriterTrait
 */
class WriterTraitTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::write
     */
    public function testWrite()
    {
        /** @var WriterInterface|PHPUnit_Framework_MockObject_MockObject $writer */
        $writer = $this->getMockForTrait(WriterTrait::class);

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
}
