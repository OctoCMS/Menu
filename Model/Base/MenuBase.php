<?php

/**
 * Menu base model for table: menu
 */

namespace Octo\Menu\Model\Base;

use DateTime;
use Block8\Database\Query;
use Octo\Model;
use Octo\Store;
use Octo\Menu\Model\Menu;

/**
 * Menu Base Model
 */
abstract class MenuBase extends Model
{
    protected function init()
    {
        $this->table = 'menu';
        $this->model = 'Menu';

        // Columns:
        
        $this->data['id'] = null;
        $this->getters['id'] = 'getId';
        $this->setters['id'] = 'setId';
        
        $this->data['name'] = null;
        $this->getters['name'] = 'getName';
        $this->setters['name'] = 'setName';
        
        $this->data['template_tag'] = null;
        $this->getters['template_tag'] = 'getTemplateTag';
        $this->setters['template_tag'] = 'setTemplateTag';
        
        // Foreign keys:
        
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
     * Get the value of Name / name
     * @return string
     */

     public function getName() : string
     {
        $rtn = $this->data['name'];

        return $rtn;
     }
    
    /**
     * Get the value of TemplateTag / template_tag
     * @return string
     */

     public function getTemplateTag() : string
     {
        $rtn = $this->data['template_tag'];

        return $rtn;
     }
    
    
    /**
     * Set the value of Id / id
     * @param $value int
     * @return Menu
     */
    public function setId(int $value) : Menu
    {

        if ($this->data['id'] !== $value) {
            $this->data['id'] = $value;
            $this->setModified('id');
        }

        return $this;
    }
    
    /**
     * Set the value of Name / name
     * @param $value string
     * @return Menu
     */
    public function setName(string $value) : Menu
    {

        if ($this->data['name'] !== $value) {
            $this->data['name'] = $value;
            $this->setModified('name');
        }

        return $this;
    }
    
    /**
     * Set the value of TemplateTag / template_tag
     * @param $value string
     * @return Menu
     */
    public function setTemplateTag(string $value) : Menu
    {

        if ($this->data['template_tag'] !== $value) {
            $this->data['template_tag'] = $value;
            $this->setModified('template_tag');
        }

        return $this;
    }
    
    

    public function MenuItems() : Query
    {
        return Store::get('MenuItem')->where('menu_id', $this->data['id']);
    }
}
