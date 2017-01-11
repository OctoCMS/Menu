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
use Octo\Menu\Store\MenuStore;

/**
 * Menu Base Model
 */
abstract class MenuBase extends Model
{
    protected $table = 'menu';
    protected $model = 'Menu';
    protected $data = [
        'id' => null,
        'name' => null,
        'template_tag' => null,
    ];

    protected $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'template_tag' => 'getTemplateTag',
    ];

    protected $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'template_tag' => 'setTemplateTag',
    ];

    /**
     * Return the database store for this model.
     * @return MenuStore
     */
    public static function Store() : MenuStore
    {
        return MenuStore::load();
    }

    /**
     * Get Menu by primary key: id
     * @param int $id
     * @return Menu|null
     */
    public static function get(int $id) : ?Menu
    {
        return self::Store()->getById($id);
    }

    /**
     * @throws \Exception
     * @return Menu
     */
    public function save() : Menu
    {
        $rtn = self::Store()->save($this);

        if (empty($rtn)) {
            throw new \Exception('Failed to save Menu');
        }

        if (!($rtn instanceof Menu)) {
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
