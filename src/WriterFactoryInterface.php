<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer;

/**
 * Creates writers.
 */
interface WriterFactoryInterface
{
    /**
     * Create a writer.
     *
     * @param WriterFieldInterface[] $fields
     * @param WriterLayoutInterface  $layout
     *
     * @return WriterInterface
     */
    public function createWriter(
        array $fields,
        WriterLayoutInterface $layout
    ): WriterInterface;
}
