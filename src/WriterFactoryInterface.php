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
     * @param WriterParametersInterface $parameters
     *
     * @return WriterInterface
     */
    public function createWriter(
        WriterParametersInterface $parameters
    ): WriterInterface;
}
