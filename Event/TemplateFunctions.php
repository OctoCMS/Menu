<?php

namespace Octo\Menu\Event;

use Octo\Event\Listener;
use Octo\Event\Manager;
use Octo\Pages\Model\Page;
use Octo\Template;
use Octo\Menu\Store\MenuItemStore;
use Octo\Menu\Store\MenuStore;

class TemplateFunctions extends Listener
{
    protected $page;

    public function registerListeners(Manager $manager)
    {
        $manager->registerListener('TemplateInit', array($this, 'registerFunctions'));
        $manager->registerListener('PageLoaded', function (Page $page) {
            $this->page = $page;
        });
    }

    public function registerFunctions(array &$functions)
    {
        $functions['renderMenu'] = function ($menuKey) {
            $menuStore = new MenuStore();
            $menuItemStore = new MenuItemStore();
            $menu = $menuStore->getByTemplateTag($menuKey);

            $menuTemplate = new Template('Menu/Menu');
            $menuItems = [];

            if ($menu) {
                $menuItems = $menuItemStore->getForMenu($menu->getId());
            }

            if (isset($menuItems) && is_array($menuItems)) {
                foreach ($menuItems as $item) {
                    if (isset($this->page) && $this->page->getUri() == $item->getUrl()) {
                        $item->setCurrent('current');
                    }
                }
            }

            $menuTemplate->key = $menuKey;
            $menuTemplate->menu = $menuItems;
            return $menuTemplate->render();
        };
    }
}
