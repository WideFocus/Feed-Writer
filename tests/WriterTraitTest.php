<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer\Tests;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Writer\Field\WriterFieldInterface;
use WideFocus\Feed\Writer\Tests\TestDouble\WriterDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Writer\WriterTrait
 */
class WriterTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return void
     *
     * @covers ::setFields
     * @covers ::getFields
     */
    public function testGetSetFields()
    {
        $fields = [
            $this->createMock(WriterFieldInterface::class)
        ];

        $writer = new WriterDouble();

        $writer->setFields($fields);
        $this->assertSame($fields, $writer->peekFields());
    }
}
