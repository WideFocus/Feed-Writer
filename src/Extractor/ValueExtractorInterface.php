<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Extractor;

use ArrayAccess;
use WideFocus\Feed\Writer\WriterFieldInterface;

/**
 * Extracts item values from fields.
 */
interface ValueExtractorInterface
{
    /**
     * Extract item values from fields.
     *
     * @param ArrayAccess            $item
     * @param WriterFieldInterface[] ...$fields
     *
     * @return string[]
     */
    public function extract(ArrayAccess $item, WriterFieldInterface ...$fields): array;
}
