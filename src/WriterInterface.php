<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer;

use ArrayAccess;
use Iterator;

/**
 * Writes a feed.
 */
interface WriterInterface
{
    /**
     * Write the feed.
     *
     * @param Iterator|ArrayAccess[] $dataIterator
     *
     * @return WriterInterface
     */
    public function write(Iterator $dataIterator): WriterInterface;
}
