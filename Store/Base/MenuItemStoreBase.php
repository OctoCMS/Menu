<?php

/**
 * MenuItem base store for table: menu_item
 */

namespace Octo\Menu\Store\Base;

use PDOException;
use b8\Cache;
use b8\Database;
use b8\Database\Query;
use b8\Database\Query\Criteria;
use b8\Exception\StoreException;
use Octo\Store;
use Octo\Menu\Model\MenuItem;
use Octo\Menu\Model\MenuItemCollection;

/**
 * MenuItem Base Store
 */
trait MenuItemStoreBase
{
    protected function init()
    {
        $this->tableName = 'menu_item';
        $this->modelName = '\Octo\Menu\Model\MenuItem';
        $this->primaryKey = 'id';
    }
    /**
    * @param $value
    * @param string $useConnection Connection type to use.
    * @throws StoreException
    * @return MenuItem
    */
    public function getByPrimaryKey($value, $useConnection = 'read')
    {
        return $this->getById($value, $useConnection);
    }


    /**
    * @param $value
    * @param string $useConnection Connection type to use.
    * @throws StoreException
    * @return MenuItem
    */
    public function getById($value, $useConnection = 'read')
    {
        if (is_null($value)) {
            throw new StoreException('Value passed to ' . __FUNCTION__ . ' cannot be null.');
        }
        // This is the primary key, so try and get from cache:
        $cacheResult = $this->getFromCache($value);

        if (!empty($cacheResult)) {
            return $cacheResult;
        }


        $query = new Query($this->getNamespace('MenuItem').'\Model\MenuItem', $useConnection);
        $query->select('*')->from('menu_item')->limit(1);
        $query->where('`id` = :id');
        $query->bind(':id', $value);

        try {
            $query->execute();
            $result = $query->fetch();

            $this->setCache($value, $result);

            return $result;
        } catch (PDOException $ex) {
            throw new StoreException('Could not get MenuItem by Id', 0, $ex);
        }
    }

    /**
     * @param $value
     * @param array $options Offsets, limits, etc.
     * @param string $useConnection Connection type to use.
     * @throws StoreException
     * @return int
     */
    public function getTotalForMenuId($value, $options = [], $useConnection = 'read')
    {
        if (is_null($value)) {
            throw new StoreException('Value passed to ' . __FUNCTION__ . ' cannot be null.');
        }

        $query = new Query($this->getNamespace('MenuItem').'\Model\MenuItem', $useConnection);
        $query->from('menu_item')->where('`menu_id` = :menu_id');
        $query->bind(':menu_id', $value);

        $this->handleQueryOptions($query, $options);

        try {
            return $query->getCount();
        } catch (PDOException $ex) {
            throw new StoreException('Could not get count of MenuItem by MenuId', 0, $ex);
        }
    }

    /**
     * @param $value
     * @param array $options Limits, offsets, etc.
     * @param string $useConnection Connection type to use.
     * @throws StoreException
     * @return MenuItemCollection
     */
    public function getByMenuId($value, $options = [], $useConnection = 'read')
    {
        if (is_null($value)) {
            throw new StoreException('Value passed to ' . __FUNCTION__ . ' cannot be null.');
        }

        $query = new Query($this->getNamespace('MenuItem').'\Model\MenuItem', $useConnection);
        $query->from('menu_item')->where('`menu_id` = :menu_id');
        $query->bind(':menu_id', $value);

        $this->handleQueryOptions($query, $options);

        try {
            $query->execute();
            return new MenuItemCollection($query->fetchAll());
        } catch (PDOException $ex) {
            throw new StoreException('Could not get MenuItem by MenuId', 0, $ex);
        }

    }

    /**
     * @param $value
     * @param array $options Offsets, limits, etc.
     * @param string $useConnection Connection type to use.
     * @throws StoreException
     * @return int
     */
    public function getTotalForPageId($value, $options = [], $useConnection = 'read')
    {
        if (is_null($value)) {
            throw new StoreException('Value passed to ' . __FUNCTION__ . ' cannot be null.');
        }

        $query = new Query($this->getNamespace('MenuItem').'\Model\MenuItem', $useConnection);
        $query->from('menu_item')->where('`page_id` = :page_id');
        $query->bind(':page_id', $value);

        $this->handleQueryOptions($query, $options);

        try {
            return $query->getCount();
        } catch (PDOException $ex) {
            throw new StoreException('Could not get count of MenuItem by PageId', 0, $ex);
        }
    }

    /**
     * @param $value
     * @param array $options Limits, offsets, etc.
     * @param string $useConnection Connection type to use.
     * @throws StoreException
     * @return MenuItemCollection
     */
    public function getByPageId($value, $options = [], $useConnection = 'read')
    {
        if (is_null($value)) {
            throw new StoreException('Value passed to ' . __FUNCTION__ . ' cannot be null.');
        }

        $query = new Query($this->getNamespace('MenuItem').'\Model\MenuItem', $useConnection);
        $query->from('menu_item')->where('`page_id` = :page_id');
        $query->bind(':page_id', $value);

        $this->handleQueryOptions($query, $options);

        try {
            $query->execute();
            return new MenuItemCollection($query->fetchAll());
        } catch (PDOException $ex) {
            throw new StoreException('Could not get MenuItem by PageId', 0, $ex);
        }

    }
}
