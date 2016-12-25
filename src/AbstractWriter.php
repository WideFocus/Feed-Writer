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
    /**
     * @var WriterFieldInterface[]
     */
    private $fields;

    /**
     * @var WriterLayoutInterface
     */
    private $layout;

    /**
     * Constructor.
     *
     * @param WriterFieldInterface[] $fields
     * @param WriterLayoutInterface  $layout
     */
    public function __construct(array $fields, WriterLayoutInterface $layout)
    {
        $this->fields = $fields;
        $this->layout = $layout;
    }

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
     * Get the fields.
     *
     * @return WriterLayoutInterface
     */
    protected function getLayout(): WriterLayoutInterface
    {
        return $this->layout;
    }
}
