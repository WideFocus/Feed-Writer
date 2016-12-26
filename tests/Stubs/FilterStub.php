<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests\Stubs;

use ArrayAccess;

class FilterStub
{
    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function __invoke($value)
    {
    }

    /**
     * @param ArrayAccess $context
     *
     * @return void
     */
    public function setContext(ArrayAccess $context)
    {
    }
}
