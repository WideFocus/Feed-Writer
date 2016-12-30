<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */
namespace WideFocus\Feed\Writer;

use ArrayAccess;
use Iterator;
use WideFocus\Feed\Writer\WriterField\WriterFieldInterface;

/**
 * Writes a feed.
 */
abstract class AbstractWriter implements WriterInterface
{
    /**
     * @var WriterFieldInterface[]
     */
    private $fields = [];

    /**
     * Write the feed.
     *
     * @param Iterator|ArrayAccess[] $dataIterator
     *
     * @return WriterInterface
     */
    public function write(Iterator $dataIterator): WriterInterface
    {
        $this->initialize();
        foreach ($dataIterator as $item) {
            $this->writeItem($item);
        }
        $this->finish();

        return $this;
    }

    /**
     * Set the writer fields.
     *
     * @param WriterFieldInterface[] $fields
     *
     * @return WriterInterface
     */
    public function setFields(array $fields): WriterInterface
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * Get the fields.
     *
     * @return WriterFieldInterface[]
     */
    protected function getFields(): array
    {
        return $this->fields;
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
