<?php

/**
 * MenuItem model collection
 */

namespace Octo\Menu\Model;

use Octo;
use b8\Model\Collection;

/**
 * MenuItem Model Collection
 */
class MenuItemCollection extends Collection
{
    /**
     * Add a MenuItem model to the collection.
     * @param string $key
     * @param MenuItem $value
     * @return MenuItemCollection
     */
    public function addMenuItem($key, MenuItem $value)
    {
        return parent::add($key, $value);
    }

    /**
     * @param $key
     * @return MenuItem|null
     */
    public function get($key)
    {
        return parent::get($key);
    }
}
