<?php

namespace cstudios\embedboards\records;

use craft\db\ActiveRecord;
use cstudios\embedboards\base\Table;

/**
 * Class EmbedConfigs
 * @package cstudios\embedboards\records
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property string $dateCreated
 * @property string $dateUpdated
 * @property string $uid
 */
class EmbedConfigs extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return Table::EMBEDCONFIGS;
    }

    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'string']
        ];
    }
}
