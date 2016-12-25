<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests\Stubs;

use ArrayAccess;
use WideFocus\Feed\Writer\AbstractWriter;

/**
 * Writes a feed.
 */
class WriterStub extends AbstractWriter
{
    /**
     * Initialize the feed.
     *
     * @return void
     */
    protected function initialize()
    {
    }

    /**
     * Write an item to the feed.
     *
     * @param ArrayAccess $item
     *
     * @return void
     */
    protected function writeItem(ArrayAccess $item)
    {
    }

    /**
     * Finish the feed.
     *
     * @return void
     */
    protected function finish()
    {
    }
}
