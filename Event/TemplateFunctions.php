<?php

namespace Octo\Menu\Event;

use Octo\Event\Listener;
use Octo\Event\Manager;
use Octo\Html\Template;
use Octo\Menu\Store\MenuItemStore;
use Octo\Menu\Store\MenuStore;

class TemplateFunctions extends Listener
{
    public function registerListeners(Manager $manager)
    {
        $manager->registerListener('PublicTemplateLoaded', array($this, 'registerFunctions'));
    }


    public function registerFunctions(Template $template)
    {
        $template->addFunction('renderMenu', function ($menuKey) use ($template) {
            $menuStore = new MenuStore();
            $menuItemStore = new MenuItemStore();
            $menu = $menuStore->getByTemplateTag($menuKey);

            $menuTemplate = Template::load('Menu', 'Menu');

            $menuItems = [];
            $menuTemplate->setContext($template->getContext());

            if ($menu) {
                $menuItems = $menuItemStore->getForMenu($menu->getId());
            }

            if (isset($menuItems) && is_array($menuItems)) {
                foreach ($menuItems as $item) {
                    if ($template->page->getUri() == $item->getUrl()) {
                        $item->setCurrent('current');
                    }
                }
            }

            $menuTemplate->menu = $menuItems;
            return $menuTemplate->render();
        });
    }
}
