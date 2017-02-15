<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace jackh\material;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{

    public $headerOptions   = ["style" => "width: 20%"];
    public $contentOptions  = ["class" => "td-actions"];
    public $buttonOptions   = ["class" => "btn"];
    public $specialOptions  = [];
    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title'      => Yii::t('yii', 'View'),
                    'aria-label' => Yii::t('yii', 'View'),
                    'data-url'   => $url,
                ], $this->buttonOptions);
                $options = isset($this->specialOptions["view"]) ? array_merge($options, $this->specialOptions["view"]) : $options;
                Html::addCssClass($options, "btn-info");
                return Html::tag("button", '<i class="material-icons">drafts</i>', $options);
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title'      => Yii::t('yii', 'Update'),
                    'aria-label' => Yii::t('yii', 'Update'),
                    'data-url'   => $url,
                ], $this->buttonOptions);
                $options = isset($this->specialOptions["update"]) ? array_merge($options, $this->specialOptions["update"]) : $options;
                Html::addCssClass($options, "btn-success");
                return Html::tag("button", '<i class="material-icons">edit</i>', $options);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title'        => Yii::t('yii', 'Delete'),
                    'aria-label'   => Yii::t('yii', 'Delete'),
                    'data-url'   => $url,
                ], $this->buttonOptions);
                $options = isset($this->specialOptions["delete"]) ? array_merge($options, $this->specialOptions["delete"]) : $options;
                Html::addCssClass($options, "btn-danger");
                return Html::tag("button", '<i class="material-icons">delete</i>', $options);
            };
        }
    }

}
