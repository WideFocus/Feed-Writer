<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Field;

/**
 * Creates writer fields.
 */
interface WriterFieldFactoryInterface
{
    /**
     * Create a writer field.
     *
     * @param string   $name
     * @param string   $label
     * @param callable $filter
     *
     * @return WriterFieldInterface
     */
    public function createField(
        string $name,
        string $label,
        callable $filter = null
    ): WriterFieldInterface;
}
