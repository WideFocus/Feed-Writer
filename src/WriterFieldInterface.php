<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer;

use ArrayAccess;

/**
 * Gets a filtered field value from a feed item.
 */
interface WriterFieldInterface
{
    /**
     * Get the name of the field.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the label of the field.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Get the value from a data object, the filter is applied.
     *
     * @param ArrayAccess $item
     *
     * @return string
     */
    public function getValue(ArrayAccess $item): string;
}
