<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Extractor;

use ArrayAccess;
use WideFocus\Feed\Writer\WriterFieldInterface;

/**
 * Extracts labels from fields.
 */
class ValueExtractor implements ValueExtractorInterface
{
    /**
     * Extract item values from fields.
     *
     * @param ArrayAccess            $item
     * @param WriterFieldInterface[] ...$fields
     *
     * @return string[]
     */
    public function extract(ArrayAccess $item, WriterFieldInterface ...$fields): array
    {
        return array_map(
            function (WriterFieldInterface $field) use ($item) : string {
                return $field->getValue($item);
            },
            $fields
        );
    }
}
