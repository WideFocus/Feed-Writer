<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests\Stubs;

use ArrayAccess;
use WideFocus\Filter\FilterInterface;

class FilterStub implements FilterInterface
{
    /**
     * Filter a value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function __invoke($value)
    {
        return $value;
    }

    /**
     * Set the context to use while filtering.
     *
     * @param ArrayAccess $context
     *
     * @return FilterInterface
     */
    public function setContext(ArrayAccess $context): FilterInterface
    {
        return $this;
    }


    /**
     * Set the parameters.
     *
     * @param array $parameters
     *
     * @return FilterInterface
     */
    public function setParameters(array $parameters): FilterInterface
    {
        return $this;
    }
}
