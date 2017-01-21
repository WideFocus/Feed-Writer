<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer;

use WideFocus\Feed\Writer\Field\WriterFieldInterface;

/**
 * Implements WriterInterface.
 */
trait WriterTrait
{
    /**
     * @var WriterFieldInterface[]
     */
    private $fields;

    /**
     * Set the writer fields.
     *
     * @param WriterFieldInterface[] $fields
     *
     * @return void
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * Get the writer fields.
     *
     * @return WriterFieldInterface[]
     */
    protected function getFields(): array
    {
        return $this->fields;
    }
}
