# WideFocus Feed Writer

This package contains models to write a feed.

## Installation

Use composer to install the package.

```shell
$ composer require widefocus/feed-writer
```

## Usage

This package is meant to be used as basis for feed writer implementations. To
do so a writer and a writer layout need to be implemented.

### Writer

The writer processes feed data. It can use a writer layout.

```php
<?php

use WideFocus\Feed\Writer\AbstractWriter;

class DebugWriter extends AbstractWriter
{
    /**
     * Write an item to the feed.
     *
     * @param ArrayAccess $item
     *
     * @return void
     */
    protected function writeItem(ArrayAccess $item)
    {
        foreach ($this->getFields() as $field) {
            echo sprintf(
                $this->getLayout()->getItemFormat(),
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

### Writer Layout

A writer layout contains information that is specific to a writer. For example
for a CSV writer it would contain information about the file destination and
the CSV control characters.
 
```php
<?php

use WideFocus\Feed\Writer\WriterLayoutInterface;

class DebugWriterLayout implements WriterLayoutInterface
{
    /**
     * @var string 
     */
    private $itemFormat;
    
    /**
     * Constructor
     * 
     * @param string $itemFormat
     */
    public function __construct(string $itemFormat)
    {
        $this->itemFormat = $itemFormat;
    }
    
    /**
     * Get the item format
     *
     * @return string  
     */
    public function getItemFormat(): string
    {
        return $this->itemFormat;
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

$layout = new DebugWriterLayout("%s: %s\n");

$writer = new DebugWriter($fields, $layout);
$writer->write($items);
```

This would result in the following output:

```text
Foo: FooValue
Bar: BARVALUE
Foo: AnotherFooValue
Bar: ANOTHERBARVALUE

```