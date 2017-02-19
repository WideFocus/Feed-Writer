<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Field;

/**
 * Extracts labels from fields.
 */
interface LabelExtractorInterface
{
    /**
     * Extract labels from fields.
     *
     * @param WriterFieldInterface[] $fields
     *
     * @return string[]
     */
    public function extract(array $fields): array;
}
