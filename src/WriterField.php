<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Writer;

use ArrayAccess;

/**
 * Gets a filtered field value from a feed item.
 */
class WriterField implements WriterFieldInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $label;

    /**
     * @var callable
     */
    private $filter;

    /**
     * Constructor.
     *
     * @param string   $name
     * @param string   $label
     * @param callable $filter
     */
    public function __construct(string $name, string $label, callable $filter = null)
    {
        $this->name   = $name;
        $this->label  = $label;
        $this->filter = $filter;
    }

    /**
     * Get the name of the field.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the label of the field.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Get the value from a data object, the filter is applied.
     *
     * @param ArrayAccess $item
     *
     * @return string
     */
    public function getValue(ArrayAccess $item): string
    {
        $value = $item->offsetExists($this->name)
            ? $item->offsetGet($this->name)
            : '';

        if (is_callable($this->filter)) {
            $value = call_user_func($this->filter, $value, $item);
        }

        return $value;
    }
}
