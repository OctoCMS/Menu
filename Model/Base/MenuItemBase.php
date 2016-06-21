<?php

/**
 * MenuItem base model for table: menu_item
 */

namespace Octo\Menu\Model\Base;

use Octo\Model;
use Octo\Store;

/**
 * MenuItem Base Model
 */
class MenuItemBase extends Model
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
        
        $this->getters['Menu'] = 'getMenu';
        $this->setters['Menu'] = 'setMenu';
        
        $this->getters['Page'] = 'getPage';
        $this->setters['Page'] = 'setPage';
        
    }

    
    /**
     * Get the value of Id / id
     * @return int
     */

     public function getId()
     {
        $rtn = $this->data['id'];

        return $rtn;
     }
    
    /**
     * Get the value of MenuId / menu_id
     * @return int
     */

     public function getMenuId()
     {
        $rtn = $this->data['menu_id'];

        return $rtn;
     }
    
    /**
     * Get the value of Title / title
     * @return string
     */

     public function getTitle()
     {
        $rtn = $this->data['title'];

        return $rtn;
     }
    
    /**
     * Get the value of PageId / page_id
     * @return string
     */

     public function getPageId()
     {
        $rtn = $this->data['page_id'];

        return $rtn;
     }
    
    /**
     * Get the value of Url / url
     * @return string
     */

     public function getUrl()
     {
        $rtn = $this->data['url'];

        return $rtn;
     }
    
    /**
     * Get the value of Position / position
     * @return int
     */

     public function getPosition()
     {
        $rtn = $this->data['position'];

        return $rtn;
     }
    
    
    /**
     * Set the value of Id / id
     * @param $value int
     */
    public function setId(int $value)
    {

        $this->validateNotNull('Id', $value);

        if ($this->data['id'] === $value) {
            return;
        }

        $this->data['id'] = $value;
        $this->setModified('id');
    }
    
    /**
     * Set the value of MenuId / menu_id
     * @param $value int
     */
    public function setMenuId(int $value)
    {


        // As this column is a foreign key, empty values should be considered null.
        if (empty($value)) {
            $value = null;
        }

        $this->validateNotNull('MenuId', $value);

        if ($this->data['menu_id'] === $value) {
            return;
        }

        $this->data['menu_id'] = $value;
        $this->setModified('menu_id');
    }
    
    /**
     * Set the value of Title / title
     * @param $value string
     */
    public function setTitle($value)
    {



        if ($this->data['title'] === $value) {
            return;
        }

        $this->data['title'] = $value;
        $this->setModified('title');
    }
    
    /**
     * Set the value of PageId / page_id
     * @param $value string
     */
    public function setPageId($value)
    {


        // As this column is a foreign key, empty values should be considered null.
        if (empty($value)) {
            $value = null;
        }



        if ($this->data['page_id'] === $value) {
            return;
        }

        $this->data['page_id'] = $value;
        $this->setModified('page_id');
    }
    
    /**
     * Set the value of Url / url
     * @param $value string
     */
    public function setUrl($value)
    {



        if ($this->data['url'] === $value) {
            return;
        }

        $this->data['url'] = $value;
        $this->setModified('url');
    }
    
    /**
     * Set the value of Position / position
     * @param $value int
     */
    public function setPosition(int $value)
    {

        $this->validateNotNull('Position', $value);

        if ($this->data['position'] === $value) {
            return;
        }

        $this->data['position'] = $value;
        $this->setModified('position');
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
}
