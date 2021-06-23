<?php

namespace cstudios\embedboards\controllers;

use craft\web\Controller;
use cstudios\embedboards\records\EmbedConfigs;
use yii\helpers\Inflector;

/**
 * Class DefaultController
 * @package cstudios\embedboards\controllers
 */
class DefaultController extends Controller
{
    public function actionDashboard(){
        $model = new EmbedConfigs();

        if (\Craft::$app->request->isPost){
            $model->load(\Craft::$app->request->post(),'');
            if ($model->save()){
                \Craft::$app->session->setNotice($model->title.' saved');
                $model = new EmbedConfigs();
            }
        }

        /** @var EmbedConfigs[] $embedConfigs */
        $embedConfigs = EmbedConfigs::find()->all();

        $configs = [];
        $tabs = [];
        $selectedTab = '';

        foreach ($embedConfigs as $embedConfig){
            if (!$selectedTab)
                $selectedTab = Inflector::slug($embedConfig->title);

            $configs[Inflector::slug($embedConfig->title)] = $embedConfig;
            $tabs[Inflector::slug($embedConfig->title)] = [
                'url' => '#'.Inflector::slug($embedConfig->title),
                'label' => $embedConfig->title
            ];
        }

        $tabs['add'] = [
            'url' => '#add',
            'label' => \Craft::t('embed-boards','Add New Board'),
        ];

        if (!$selectedTab)
            $selectedTab = 'add';

        return $this->renderTemplate('embed-boards/default/dashboard',[
            'configs' => $configs,
            'model' => $model,
            'tabs' => $tabs,
            'selectedTab' => $selectedTab
        ]);
    }

    public function actionDelete($id){
        $config = EmbedConfigs::findOne($id);
        if ($config->delete()){

            \Craft::$app->session->setNotice($config->title.' deleted');
        }

        return $this->redirect('/admin/embed-boards/dashboard');
    }
}
