<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Writer;

/**
 * Creates parameters objects.
 */
interface WriterParametersFactoryInterface
{
    /**
     * Create a parameters object.
     *
     * @param array $data
     *
     * @return WriterParametersInterface
     */
    public function createParameters(array $data = []): WriterParametersInterface;
}