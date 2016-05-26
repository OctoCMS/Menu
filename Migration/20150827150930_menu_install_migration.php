<?php

use Phinx\Migration\AbstractMigration;

class MenuInstallMigration extends AbstractMigration
{
    public function up()
    {
        // Create tables:
        $this->createMenu();
        $this->createMenuItem();

        // Add foreign keys:
        $table = $this->table('menu_item');

        if (!$table->hasForeignKey('menu_id')) {
            $table->addForeignKey('menu_id', 'menu', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE']);
            $table->save();
        }

        if (!$table->hasForeignKey('page_id') && $this->hasTable('page')) {
            $table->addForeignKey('page_id', 'page', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE']);
            $table->save();
        }
    }

    protected function createMenu()
    {
        $table = $this->table('menu', ['id' => false, 'primary_key' => ['id']]);

        if (!$this->hasTable('menu')) {
            $table->addColumn('id', 'integer', ['signed' => false, 'null' => false, 'identity' => true]);
            $table->create();
        }

        if (!$table->hasColumn('name')) {
            $table->addColumn('name', 'string', ['limit' => 250, 'null' => false]);
        }

        if (!$table->hasColumn('template_tag')) {
            $table->addColumn('template_tag', 'string', ['limit' => 250, 'null' => false]);
        }

        if (!$table->hasIndex('template_tag')) {
            $table->addIndex('template_tag', ['unique' => true]);
        }

        $table->save();

        $table->changeColumn('name', 'string', ['limit' => 250, 'null' => false]);
        $table->changeColumn('template_tag', 'string', ['limit' => 250, 'null' => false]);

        $table->save();
    }

    protected function createMenuItem()
    {
        $table = $this->table('menu_item', ['id' => false, 'primary_key' => ['id']]);

        if (!$this->hasTable('menu_item')) {
            $table->addColumn('id', 'integer', ['signed' => false, 'null' => false, 'identity' => true]);
            $table->create();
        }

        if (!$table->hasColumn('menu_id')) {
            $table->addColumn('menu_id', 'integer', ['signed' => false, 'null' => false]);
        }

        if (!$table->hasColumn('title')) {
            $table->addColumn('title', 'string', ['limit' => 250, 'null' => true, 'default' => null]);
        }

        if (!$table->hasColumn('page_id')) {
            $table->addColumn('page_id', 'char', ['limit' => 5, 'null' => true, 'default' => null]);
        }

        if (!$table->hasColumn('url')) {
            $table->addColumn('url', 'string', ['limit' => 250, 'null' => true, 'default' => null]);
        }

        if (!$table->hasColumn('position')) {
            $table->addColumn('position', 'integer', ['null' => false, 'default' => 0]);
        }

        $table->save();

        $table->changeColumn('title', 'string', ['limit' => 250, 'null' => true, 'default' => null]);
        $table->changeColumn('url', 'string', ['limit' => 250, 'null' => true, 'default' => null]);
        $table->changeColumn('position', 'integer', ['null' => false, 'default' => 0]);

        $table->save();
    }
}
