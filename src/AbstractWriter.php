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
abstract class AbstractWriter implements WriterInterface
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
        $this->initialize();
        foreach ($dataIterator as $item) {
            $this->writeItem($item);
        }
        $this->finish();
    }

    /**
     * Initialize the feed.
     *
     * @return void
     */
    abstract protected function initialize();

    /**
     * Write an item to the feed.
     *
     * @param ArrayAccess $item
     *
     * @return void
     */
    abstract protected function writeItem(ArrayAccess $item);

    /**
     * Finish the feed.
     *
     * @return void
     */
    abstract protected function finish();
}
