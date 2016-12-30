<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\WriterField;

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
