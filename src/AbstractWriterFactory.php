<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer;

/**
 * Creates writers.
 */
abstract class AbstractWriterFactory implements WriterFactoryInterface
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
    ): WriterInterface {
        $className = $this->getWriterClassName();
        return new $className($fields, $layout);
    }

    /**
     * Get the class name of the writer to create.
     *
     * @return string
     */
    abstract protected function getWriterClassName(): string;
}
