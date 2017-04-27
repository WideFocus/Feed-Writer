<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Extractor;

use WideFocus\Feed\Writer\WriterFieldInterface;

/**
 * Extracts labels from fields.
 */
class LabelExtractor implements LabelExtractorInterface
{
    /**
     * Extract labels from fields.
     *
     * @param WriterFieldInterface[] ...$fields
     *
     * @return string[]
     */
    public function extract(WriterFieldInterface ...$fields): array
    {
        return array_map(
            function (WriterFieldInterface $field) : string {
                return $field->getLabel();
            },
            $fields
        );
    }
}
