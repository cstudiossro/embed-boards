<?php

namespace cstudios\embedboards\migrations;

use Craft;
use craft\db\Migration;
use cstudios\embedboards\base\Table;

/**
 * Install migration.
 */
class Install extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(Table::EMBEDCONFIGS,[
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'code' => $this->longText(),
            'dateCreated' => $this->dateTime(),
            'dateUpdated' => $this->dateTime(),
            'uid' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable(Table::EMBEDCONFIGS);
    }
}
