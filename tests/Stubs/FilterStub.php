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
     * @param mixed       $value
     * @param ArrayAccess $item
     *
     * @return mixed
     */
    public function __invoke($value, ArrayAccess $item)
    {
    }
}
