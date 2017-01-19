<?php

/**
 * MenuItem base model for table: menu_item
 */

namespace Octo\Menu\Model\Base;

use DateTime;
use Block8\Database\Query;
use Octo\Model;
use Octo\Store;

use Octo\Menu\Store\MenuItemStore;
use Octo\Menu\Model\MenuItem;
use Octo\Pages\Model\Page;
use Octo\Menu\Model\Menu;

/**
 * MenuItem Base Model
 */
abstract class MenuItemBase extends Model
{
    protected $table = 'menu_item';
    protected $model = 'MenuItem';
    protected $data = [
        'id' => null,
        'menu_id' => null,
        'title' => null,
        'page_id' => null,
        'url' => null,
        'position' => 0,
    ];

    protected $getters = [
        'id' => 'getId',
        'menu_id' => 'getMenuId',
        'title' => 'getTitle',
        'page_id' => 'getPageId',
        'url' => 'getUrl',
        'position' => 'getPosition',
        'Page' => 'getPage',
        'Menu' => 'getMenu',
    ];

    protected $setters = [
        'id' => 'setId',
        'menu_id' => 'setMenuId',
        'title' => 'setTitle',
        'page_id' => 'setPageId',
        'url' => 'setUrl',
        'position' => 'setPosition',
        'Page' => 'setPage',
        'Menu' => 'setMenu',
    ];

    /**
     * Return the database store for this model.
     * @return MenuItemStore
     */
    public static function Store() : MenuItemStore
    {
        return MenuItemStore::load();
    }

    /**
     * Get MenuItem by primary key: id
     * @param int $id
     * @return MenuItem|null
     */
    public static function get(int $id) : ?MenuItem
    {
        return self::Store()->getById($id);
    }

    /**
     * @throws \Exception
     * @return MenuItem
     */
    public function save() : MenuItem
    {
        $rtn = self::Store()->save($this);

        if (empty($rtn)) {
            throw new \Exception('Failed to save MenuItem');
        }

        if (!($rtn instanceof MenuItem)) {
            throw new \Exception('Unexpected ' . get_class($rtn) . ' received from save.');
        }

        $this->data = $rtn->toArray();

        return $this;
    }


    /**
     * Get the value of Id / id
     * @return int
     */
     public function getId() : int
     {
        $rtn = $this->data['id'];

        return $rtn;
     }
    
    /**
     * Get the value of MenuId / menu_id
     * @return int
     */
     public function getMenuId() : int
     {
        $rtn = $this->data['menu_id'];

        return $rtn;
     }
    
    /**
     * Get the value of Title / title
     * @return string
     */
     public function getTitle() : ?string
     {
        $rtn = $this->data['title'];

        return $rtn;
     }
    
    /**
     * Get the value of PageId / page_id
     * @return string
     */
     public function getPageId() : ?string
     {
        $rtn = $this->data['page_id'];

        return $rtn;
     }
    
    /**
     * Get the value of Url / url
     * @return string
     */
     public function getUrl() : ?string
     {
        $rtn = $this->data['url'];

        return $rtn;
     }
    
    /**
     * Get the value of Position / position
     * @return int
     */
     public function getPosition() : int
     {
        $rtn = $this->data['position'];

        return $rtn;
     }
    
    
    /**
     * Set the value of Id / id
     * @param $value int
     * @return MenuItem
     */
    public function setId(int $value) : MenuItem
    {

        if ($this->data['id'] !== $value) {
            $this->data['id'] = $value;
            $this->setModified('id');
        }

        return $this;
    }
    
    /**
     * Set the value of MenuId / menu_id
     * @param $value int
     * @return MenuItem
     */
    public function setMenuId(int $value) : MenuItem
    {

        // As this column is a foreign key, empty values should be considered null.
        if (empty($value)) {
            $value = null;
        }


        if ($this->data['menu_id'] !== $value) {
            $this->data['menu_id'] = $value;
            $this->setModified('menu_id');
        }

        return $this;
    }
    
    /**
     * Set the value of Title / title
     * @param $value string
     * @return MenuItem
     */
    public function setTitle(?string $value) : MenuItem
    {

        if ($this->data['title'] !== $value) {
            $this->data['title'] = $value;
            $this->setModified('title');
        }

        return $this;
    }
    
    /**
     * Set the value of PageId / page_id
     * @param $value string
     * @return MenuItem
     */
    public function setPageId(?string $value) : MenuItem
    {

        // As this column is a foreign key, empty values should be considered null.
        if (empty($value)) {
            $value = null;
        }


        if ($this->data['page_id'] !== $value) {
            $this->data['page_id'] = $value;
            $this->setModified('page_id');
        }

        return $this;
    }
    
    /**
     * Set the value of Url / url
     * @param $value string
     * @return MenuItem
     */
    public function setUrl(?string $value) : MenuItem
    {

        if ($this->data['url'] !== $value) {
            $this->data['url'] = $value;
            $this->setModified('url');
        }

        return $this;
    }
    
    /**
     * Set the value of Position / position
     * @param $value int
     * @return MenuItem
     */
    public function setPosition(int $value) : MenuItem
    {

        if ($this->data['position'] !== $value) {
            $this->data['position'] = $value;
            $this->setModified('position');
        }

        return $this;
    }
    

    /**
     * Get the Page model for this  by Id.
     *
     * @uses \Octo\Pages\Store\PageStore::getById()
     * @uses Page
     * @return Page|null
     */
    public function getPage() : ?Page
    {
        $key = $this->getPageId();

        if (empty($key)) {
           return null;
        }

        return Page::Store()->getById($key);
    }

    /**
     * Set Page - Accepts an ID, an array representing a Page or a Page model.
     * @throws \Exception
     * @param $value mixed
     * @return MenuItem
     */
    public function setPage($value) : MenuItem
    {
        // Is this a scalar value representing the ID of this foreign key?
        if (is_scalar($value)) {
            return $this->setPageId($value);
        }

        // Is this an instance of Page?
        if (is_object($value) && $value instanceof Page) {
            return $this->setPageObject($value);
        }

        // Is this an array representing a Page item?
        if (is_array($value) && !empty($value['id'])) {
            return $this->setPageId($value['id']);
        }

        // None of the above? That's a problem!
        throw new \Exception('Invalid value for Page.');
    }

    /**
     * Set Page - Accepts a Page model.
     *
     * @param $value Page
     * @return MenuItem
     */
    public function setPageObject(Page $value) : MenuItem
    {
        return $this->setPageId($value->getId());
    }

    /**
     * Get the Menu model for this  by Id.
     *
     * @uses \Octo\Menu\Store\MenuStore::getById()
     * @uses Menu
     * @return Menu|null
     */
    public function getMenu() : ?Menu
    {
        $key = $this->getMenuId();

        if (empty($key)) {
           return null;
        }

        return Menu::Store()->getById($key);
    }

    /**
     * Set Menu - Accepts an ID, an array representing a Menu or a Menu model.
     * @throws \Exception
     * @param $value mixed
     * @return MenuItem
     */
    public function setMenu($value) : MenuItem
    {
        // Is this a scalar value representing the ID of this foreign key?
        if (is_scalar($value)) {
            return $this->setMenuId($value);
        }

        // Is this an instance of Menu?
        if (is_object($value) && $value instanceof Menu) {
            return $this->setMenuObject($value);
        }

        // Is this an array representing a Menu item?
        if (is_array($value) && !empty($value['id'])) {
            return $this->setMenuId($value['id']);
        }

        // None of the above? That's a problem!
        throw new \Exception('Invalid value for Menu.');
    }

    /**
     * Set Menu - Accepts a Menu model.
     *
     * @param $value Menu
     * @return MenuItem
     */
    public function setMenuObject(Menu $value) : MenuItem
    {
        return $this->setMenuId($value->getId());
    }
}
