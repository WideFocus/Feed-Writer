<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests;

use Iterator;
use PHPUnit_Framework_MockObject_MockObject;

trait IterationMockTrait
{
    /**
     * Mock an iterator.
     *
     * @param Iterator|PHPUnit_Framework_MockObject_MockObject $iterator
     * @param array                                            $items
     *
     * @return void
     */
    protected function mockIteration(
        Iterator $iterator,
        array $items
    ) {
        $iterator->expects($this->at(0))
            ->method('rewind');

        $counter = 1;
        foreach ($items as $value) {
            $iterator->expects($this->at($counter++))
                ->method('valid')
                ->willReturn(true);

            $iterator->expects($this->at($counter++))
                ->method('current')
                ->willReturn($value);

            $iterator->expects($this->at($counter++))
                ->method('next');
        }

        $iterator->expects($this->at($counter))
            ->method('valid')
            ->willReturn(false);
    }
}
