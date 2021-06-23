<?php

namespace cstudios\embedboards;

use craft\base\Plugin as BasePlugin;
use craft\events\RegisterCpNavItemsEvent;
use craft\events\RegisterTemplateRootsEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\web\twig\variables\Cp;
use craft\web\UrlManager;
use craft\web\View;
use cstudios\embedboards\models\Settings;
use yii\base\Event;

/**
 * Class Plugin
 * @package cstudios\embedboards
 */
class Plugin extends BasePlugin
{
    public $hasCpSettings = true;

    public function init()
    {
        parent::init();

        \Craft::setAlias('@embedboards',__DIR__);

        $this->configure();
    }

    public function configure(){
        Event::on(
            Cp::class,
            Cp::EVENT_REGISTER_CP_NAV_ITEMS,
            function(RegisterCpNavItemsEvent $event) {

                /** @var Settings $settings */
                $settings = $this->getSettings();
                $label = $settings->navItemLabel ? $settings->navItemLabel : 'Embed Boards';

                $event->navItems[] = [
                    'url' => 'embed-boards',
                    'label' => $label,
                    'icon' => '@embedboards/icon-mask.svg',
                ];
            }
        );

        Event::on(
            View::class,
            View::EVENT_REGISTER_CP_TEMPLATE_ROOTS,
            function(RegisterTemplateRootsEvent $event) {
                $event->roots['embed-boards'] = __DIR__ . '/templates';
            }
        );

        Event::on(UrlManager::class, UrlManager::EVENT_REGISTER_CP_URL_RULES, function(RegisterUrlRulesEvent $e) {
            $e->rules['embed-boards'] = 'embed-boards/default/dashboard';
            $e->rules['embed-boards/dashboard'] = 'embed-boards/default/dashboard';
            $e->rules['embed-boards/delete'] = 'embed-boards/default/delete';
        });
    }

    /**
     * @inheritDoc
     */
    protected function settingsHtml()
    {
        return \Craft::$app->getView()->renderTemplate(
            'embed-boards/settings',
            [ 'settings' => $this->getSettings() ]
        );
    }

    /**
     * @return Settings
     */
    protected function createSettingsModel()
    {
       return new Settings();
    }
}
