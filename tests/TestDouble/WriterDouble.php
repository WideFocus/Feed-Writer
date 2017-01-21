<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests\TestDouble;

use ArrayAccess;
use Iterator;
use WideFocus\Feed\Writer\Field\WriterFieldInterface;
use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Feed\Writer\WriterTrait;

class WriterDouble implements WriterInterface
{
    use WriterTrait;

    /**
     * Write the feed.
     *
     * @param Iterator|ArrayAccess[] $dataIterator
     *
     * @return void
     */
    public function write(Iterator $dataIterator)
    {
    }

    /**
     * @return WriterFieldInterface[]
     */
    public function peekFields(): array
    {
        return $this->getFields();
    }
}
