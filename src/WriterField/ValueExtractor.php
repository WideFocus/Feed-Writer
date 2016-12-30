<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\WriterField;

use ArrayAccess;

/**
 * Extracts labels from fields.
 */
class ValueExtractor implements ValueExtractorInterface
{
    /**
     * Extract item values from fields.
     *
     * @param WriterFieldInterface[] $fields
     * @param ArrayAccess            $item
     *
     * @return string[]
     */
    public function extract(array $fields, ArrayAccess $item): array
    {
        return array_map(
            function (WriterFieldInterface $field) use ($item): string {
                return $field->getValue($item);
            },
            $fields
        );
    }
}
