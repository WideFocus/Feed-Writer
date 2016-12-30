<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests;

use ArrayAccess;
use PHPUnit_Framework_MockObject_MockObject;
use WideFocus\Feed\Writer\Tests\Stubs\FilterStub;
use WideFocus\Feed\Writer\WriterField\WriterFieldInterface;
use WideFocus\Feed\Writer\WriterLayoutInterface;

/**
 * Contains methods to create mocks for common objects.
 */
trait CommonMocksTrait
{
    /**
     * @return WriterLayoutInterface|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createWriterLayoutMock(): WriterLayoutInterface
    {
        return $this->createMock(WriterLayoutInterface::class);
    }

    /**
     * @return WriterFieldInterface|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createWriterFieldMock(): WriterFieldInterface
    {
        return $this->createMock(WriterFieldInterface::class);
    }

    /**
     * @return ArrayAccess|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createFeedItemMock(): ArrayAccess
    {
        return $this->createMock(ArrayAccess::class);
    }

    /**
     * @return callable|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createFilterMock(): callable
    {
        return $this->createMock(FilterStub::class);
    }

    /**
     * @param string $originalClassName
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    abstract protected function createMock($originalClassName);  // @codingStandardsIgnoreLine
}
