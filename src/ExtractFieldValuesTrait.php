<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer;

use ArrayAccess;

trait ExtractFieldValuesTrait
{
    /**
     * Extract item values from fields.
     *
     * @param ArrayAccess            $item
     * @param WriterFieldInterface[] ...$fields
     *
     * @return string[]
     */
    protected function extractFieldValues(
        ArrayAccess $item,
        WriterFieldInterface ...$fields
    ): array {
        return array_map(
            function (WriterFieldInterface $field) use ($item) : string {
                return $field->getValue($item);
            },
            $fields
        );
    }
}
