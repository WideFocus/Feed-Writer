<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer;

trait ExtractFieldLabelsTrait
{
    /**
     * Extract labels from fields.
     *
     * @param WriterFieldInterface[] ...$fields
     *
     * @return string[]
     */
    protected function extractFieldLabels(
        WriterFieldInterface ...$fields
    ): array {
        return array_map(
            function (WriterFieldInterface $field) : string {
                return $field->getLabel();
            },
            $fields
        );
    }
}
