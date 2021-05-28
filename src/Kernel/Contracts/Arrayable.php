<?php

namespace EasyJiGuang\Kernel\Contracts;

use ArrayAccess;

/**
 * Interface Arrayable
 * @package EasyJiGuang\Kernel\Contracts
 */
interface Arrayable extends ArrayAccess
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray();
}