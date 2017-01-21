<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Field;

/**
 * Creates writer fields.
 */
class WriterFieldFactory implements WriterFieldFactoryInterface
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
    ): WriterFieldInterface {
        return new WriterField($name, $label, $filter);
    }
}
