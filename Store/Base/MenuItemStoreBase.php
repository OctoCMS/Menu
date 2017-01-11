<?php

/**
 * MenuItem base store for table: menu_item

 */

namespace Octo\Menu\Store\Base;

use Block8\Database\Connection;
use Octo\Store;
use Octo\Menu\Model\MenuItem;
use Octo\Menu\Model\MenuItemCollection;
use Octo\Menu\Store\MenuItemStore;

/**
 * MenuItem Base Store
 */
class MenuItemStoreBase extends Store
{
    /** @var MenuItemStore $instance */
    protected static $instance = null;

    /** @var string */
    protected $table = 'menu_item';

    /** @var string */
    protected $model = 'Octo\Menu\Model\MenuItem';

    /** @var string */
    protected $key = 'id';

    /**
     * Return the database store for this model.
     * @return MenuItemStore
     */
    public static function load() : MenuItemStore
    {
        if (is_null(self::$instance)) {
            self::$instance = new MenuItemStore(Connection::get());
        }

        return self::$instance;
    }

    /**
    * @param $value
    * @return MenuItem|null
    */
    public function getByPrimaryKey($value)
    {
        return $this->getById($value);
    }


    /**
     * Get a MenuItem object by Id.
     * @param $value
     * @return MenuItem|null
     */
    public function getById(int $value)
    {
        // This is the primary key, so try and get from cache:
        $cacheResult = $this->cacheGet($value);

        if (!empty($cacheResult)) {
            return $cacheResult;
        }

        $rtn = $this->where('id', $value)->first();
        $this->cacheSet($value, $rtn);

        return $rtn;
    }

    /**
     * Get all MenuItem objects by MenuId.
     * @return \Octo\Menu\Model\MenuItemCollection
     */
    public function getByMenuId($value, $limit = null)
    {
        return $this->where('menu_id', $value)->get($limit);
    }

    /**
     * Gets the total number of MenuItem by MenuId value.
     * @return int
     */
    public function getTotalByMenuId($value) : int
    {
        return $this->where('menu_id', $value)->count();
    }

    /**
     * Get all MenuItem objects by PageId.
     * @return \Octo\Menu\Model\MenuItemCollection
     */
    public function getByPageId($value, $limit = null)
    {
        return $this->where('page_id', $value)->get($limit);
    }

    /**
     * Gets the total number of MenuItem by PageId value.
     * @return int
     */
    public function getTotalByPageId($value) : int
    {
        return $this->where('page_id', $value)->count();
    }
}
