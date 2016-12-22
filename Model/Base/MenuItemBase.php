<?php

/**
 * MenuItem base model for table: menu_item
 */

namespace Octo\Menu\Model\Base;

use DateTime;
use Block8\Database\Query;
use Octo\Model;
use Octo\Store;
use Octo\Menu\Model\MenuItem;

/**
 * MenuItem Base Model
 */
abstract class MenuItemBase extends Model
{
    protected function init()
    {
        $this->table = 'menu_item';
        $this->model = 'MenuItem';

        // Columns:
        
        $this->data['id'] = null;
        $this->getters['id'] = 'getId';
        $this->setters['id'] = 'setId';
        
        $this->data['menu_id'] = null;
        $this->getters['menu_id'] = 'getMenuId';
        $this->setters['menu_id'] = 'setMenuId';
        
        $this->data['title'] = null;
        $this->getters['title'] = 'getTitle';
        $this->setters['title'] = 'setTitle';
        
        $this->data['page_id'] = null;
        $this->getters['page_id'] = 'getPageId';
        $this->setters['page_id'] = 'setPageId';
        
        $this->data['url'] = null;
        $this->getters['url'] = 'getUrl';
        $this->setters['url'] = 'setUrl';
        
        $this->data['position'] = null;
        $this->getters['position'] = 'getPosition';
        $this->setters['position'] = 'setPosition';
        
        // Foreign keys:
        
        $this->getters['Page'] = 'getPage';
        $this->setters['Page'] = 'setPage';
        
        $this->getters['Menu'] = 'getMenu';
        $this->setters['Menu'] = 'setMenu';
        
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
     * @uses \Octo\Pages\Model\Page
     * @return \Octo\Pages\Model\Page
     */
    public function getPage()
    {
        $key = $this->getPageId();

        if (empty($key)) {
           return null;
        }

        return Store::get('Page')->getById($key);
    }

    /**
     * Set Page - Accepts an ID, an array representing a Page or a Page model.
     * @throws \Exception
     * @param $value mixed
     */
    public function setPage($value)
    {
        // Is this a scalar value representing the ID of this foreign key?
        if (is_scalar($value)) {
            return $this->setPageId($value);
        }

        // Is this an instance of Page?
        if (is_object($value) && $value instanceof \Octo\Pages\Model\Page) {
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
     * @param $value \Octo\Pages\Model\Page
     */
    public function setPageObject(\Octo\Pages\Model\Page $value)
    {
        return $this->setPageId($value->getId());
    }

    /**
     * Get the Menu model for this  by Id.
     *
     * @uses \Octo\Menu\Store\MenuStore::getById()
     * @uses \Octo\Menu\Model\Menu
     * @return \Octo\Menu\Model\Menu
     */
    public function getMenu()
    {
        $key = $this->getMenuId();

        if (empty($key)) {
           return null;
        }

        return Store::get('Menu')->getById($key);
    }

    /**
     * Set Menu - Accepts an ID, an array representing a Menu or a Menu model.
     * @throws \Exception
     * @param $value mixed
     */
    public function setMenu($value)
    {
        // Is this a scalar value representing the ID of this foreign key?
        if (is_scalar($value)) {
            return $this->setMenuId($value);
        }

        // Is this an instance of Menu?
        if (is_object($value) && $value instanceof \Octo\Menu\Model\Menu) {
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
     * @param $value \Octo\Menu\Model\Menu
     */
    public function setMenuObject(\Octo\Menu\Model\Menu $value)
    {
        return $this->setMenuId($value->getId());
    }

}
