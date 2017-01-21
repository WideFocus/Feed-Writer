<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Field;

/**
 * Extracts labels from fields.
 */
class LabelExtractor implements LabelExtractorInterface
{
    /**
     * Extract labels from fields.
     *
     * @param WriterFieldInterface[] $fields
     *
     * @return string[]
     */
    public function extract(array $fields): array
    {
        return array_map(
            function (WriterFieldInterface $field): string {
                return $field->getLabel();
            },
            $fields
        );
    }
}
