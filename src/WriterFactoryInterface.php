<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer;

use WideFocus\Feed\Writer\Field\WriterFieldInterface;

/**
 * Creates writers.
 */
interface WriterFactoryInterface
{
    /**
     * Create a writer.
     *
     * @param WriterFieldInterface[]    $fields
     * @param WriterParametersInterface $parameters
     *
     * @return WriterInterface
     */
    public function createWriter(
        array $fields,
        WriterParametersInterface $parameters
    ): WriterInterface;
}
