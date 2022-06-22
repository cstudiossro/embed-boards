<?php

namespace cstudios\embedboards\models;

use craft\base\Model;

/**
 * Class Settings
 * @package cstudios\embedboards
 */
class Settings extends Model
{
    /**
     * @var string
     */
    public $navItemLabel;

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['navItemLabel'], 'string'],
        ];
    }
}
