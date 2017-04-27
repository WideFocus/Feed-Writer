<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
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
     * @return void
     */
    public function write(Iterator $dataIterator);
}
