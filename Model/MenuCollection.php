<?php

/**
 * Menu model collection
 */

namespace Octo\Menu\Model;

use Octo;
use b8\Model\Collection;

/**
 * Menu Model Collection
 */
class MenuCollection extends Collection
{
    /**
     * Add a Menu model to the collection.
     * @param string $key
     * @param Menu $value
     * @return MenuCollection
     */
    public function addMenu($key, Menu $value)
    {
        return parent::add($key, $value);
    }

    /**
     * @param $key
     * @return Menu|null
     */
    public function get($key)
    {
        return parent::get($key);
    }
}
