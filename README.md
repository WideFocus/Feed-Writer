# WideFocus Feed Writer

[![Build Status](https://travis-ci.org/WideFocus/Feed-Writer.svg?branch=master)](https://travis-ci.org/WideFocus/Feed-Writer)
[![Latest Stable Version](https://poser.pugx.org/widefocus/feed-writer/v/stable)](https://packagist.org/packages/widefocus/feed-writer)
[![License](https://poser.pugx.org/widefocus/feed-writer/license)](https://packagist.org/packages/widefocus/feed-writer)

This package contains models to write a feed.

## Installation

Use composer to install the package.

```shell
$ composer require widefocus/feed-writer
```

## Usage

This package is meant to be used as basis for feed writer implementations. To
do so a writer needs to be implemented.

### Writer

The writer processes feed data.

```php
<?php

use WideFocus\Feed\Writer\WriterInterface;
use WideFocus\Feed\Writer\WriterFieldInterface;
use WideFocus\Feed\Writer\WriterTrait;

class DebugWriter implements WriterInterface
{
    use WriterTrait;

    /**
     * @var WriterFieldInterface[]
     */
    private $fields;

    /**
     * Constructor.
     *
     * @param WriterFieldInterface[] $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * Write an item to the feed.
     *
     * @param ArrayAccess $item
     *
     * @return void
     */
    protected function writeItem(ArrayAccess $item)
    {
        foreach ($this->fields as $field) {
            echo sprintf(
                "%s: %s\n",
                $field->getLabel(),
                $field->getValue($item)
            );
        }
    }

    /**
     * Initialize the feed.
     *
     * @return void
     */
    protected function initialize()
    {
    }

    /**
     * Finish the feed.
     *
     * @return void
     */
    protected function finish()
    {
    }
}
```

### Writing the feed

The writer expects an iterator as it's input. The iterator is expected to
contain items that implement the ArrayAccess interface.

```php
<?php

use WideFocus\Feed\Writer\WriterField;

$items = new ArrayIterator(
    [
        new ArrayObject(['foo' => 'FooValue', 'bar' => 'BarValue']),
        new ArrayObject(['foo' => 'AnotherFooValue', 'bar' => 'AnotherBarValue'])
    ]
);

$fields = [
    new WriterField('foo', 'Foo'),
    new WriterField('bar', 'Bar', 'strtoupper')
];

$writer = new DebugWriter($fields);
$writer->write($items);
```

This would result in the following output:

```text
Foo: FooValue
Bar: BARVALUE
Foo: AnotherFooValue
Bar: ANOTHERBARVALUE

```