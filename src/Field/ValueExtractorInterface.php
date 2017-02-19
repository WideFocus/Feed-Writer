<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Field;

use ArrayAccess;

/**
 * Extracts item values from fields.
 */
interface ValueExtractorInterface
{
    /**
     * Extract item values from fields.
     *
     * @param WriterFieldInterface[] $fields
     * @param ArrayAccess            $item
     *
     * @return string[]
     */
    public function extract(array $fields, ArrayAccess $item): array;
}
