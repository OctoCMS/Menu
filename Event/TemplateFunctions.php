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
        $template->addFunction('renderMenu', function ($menuKey) {
            $menuStore = new MenuStore();
            $menuItemStore = new MenuItemStore();

            $menu = $menuStore->getByTemplateTag($menuKey);

            $template = Template::load('Menu', 'Menu');

            if ($menu) {
                $template->menu = $menuItemStore->getForMenu($menu->getId());
            }

            if (isset($template->menu) && is_array($template->menu)) {
                foreach ($template->menu as $item) {
                    if ($this->page->getUri() == $item->getPage()->getUri()) {
                        $item->setCurrent('current');
                    }
                }
            }

            return $template->render();
        });
    }
}
