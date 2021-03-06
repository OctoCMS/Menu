<?php

/**
 * Menu base store for table: menu

 */

namespace Octo\Menu\Store\Base;

use Block8\Database\Connection;
use Octo\Store;
use Octo\Menu\Model\Menu;
use Octo\Menu\Model\MenuCollection;
use Octo\Menu\Store\MenuStore;

/**
 * Menu Base Store
 */
class MenuStoreBase extends Store
{
    /** @var MenuStore $instance */
    protected static $instance = null;

    /** @var string */
    protected $table = 'menu';

    /** @var string */
    protected $model = 'Octo\Menu\Model\Menu';

    /** @var string */
    protected $key = 'id';

    /**
     * Return the database store for this model.
     * @return MenuStore
     */
    public static function load() : MenuStore
    {
        if (is_null(self::$instance)) {
            self::$instance = new MenuStore(Connection::get());
        }

        return self::$instance;
    }

    /**
    * @param $value
    * @return Menu|null
    */
    public function getByPrimaryKey($value)
    {
        return $this->getById($value);
    }


    /**
     * Get a Menu object by Id.
     * @param $value
     * @return Menu|null
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
     * Get a Menu object by TemplateTag.
     * @param $value
     * @return Menu|null
     */
    public function getByTemplateTag(string $value)
    {
        return $this->where('template_tag', $value)->first();
    }
}
