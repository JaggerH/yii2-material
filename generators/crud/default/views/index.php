<?php

use Yii;

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
$camelName = Inflector::camel2id(StringHelper::basename($generator->modelClass));
$baseName = StringHelper::basename($generator->modelClass);
echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
use <?=$generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView"?>;
<?=$generator->enablePjax ? 'use yii\widgets\Pjax;' : ''?>

/* @var $this yii\web\View */
<?=!empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : ''?>
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="<?=$camelName?>-index col-xs-12">

    <?="<?= "?>$this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?="<?="?> Html::a(Yii::t("app", "Create"), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if ($generator->indexWidgetType === 'grid'): ?>
    <?=$generator->enablePjax ? '
    <?php Pjax::begin([
        "id" => "' . $baseName . 'Container",
        "options" => [
            "data-reload-url" => Url::to(["' . $camelName . '/index"])
        ]
    ]); ?>' : ''?>

    <?="<?= "?>GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'tableOptions' => ["class" => "table text-left"],
        'columns' => [
<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
	foreach ($generator->getColumnNames() as $name) {
		if (++$count < 6) {
			echo "            '" . $name . "',\n";
		} else {
			echo "            // '" . $name . "',\n";
		}
	}
} else {
	foreach ($tableSchema->columns as $column) {
		$format = $generator->generateColumnFormat($column);
		if (++$count < 6) {
			echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
		} else {
			echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
		}
	}
}
?>
            [
                'class' => 'jackh\material\ActionColumn',
                'specialOptions' => [
                    'view' => ['data-load' => "#dashboard-modal", "expanded" => "true"],
                    'delete' => ['pjax-delete' => ""],
                    'update' => ['data-load' => "#dashboard-content", "expanded" => "true"],
                ],
                'urlCreator' => function($action, $model, $key, $index) {
                    $params = is_array($key) ? $key : ['id' => (string) $key];
                    $params[0] = '<?=$camelName?>/' . $action;
                    return Url::toRoute($params);
                }],
            ],
    ]); ?>
    <?=$generator->enablePjax ? "\n" . '    <?php Pjax::end(); ?>' : ''?>

    </div>
<?php else: ?>
    <?="<?= "?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'summary' => '',
        'itemView' => function ($model, $key, $index, $widget) {
            $widget->itemOptions = array_merge($widget->itemOptions, [
                "data-url"  => Url::toRoute(['update', 'id' => $model->id]),
                "data-delete-url"  => Url::toRoute(['delete', 'id' => $model->id]),
                "data-load" => "#dashboard-content",
            ]);
            $title = Html::tag("p", Html::encode($model->title), ["class" => "title"]);
            return Html::tag("div", $title, ["class" => "content"]);
        },
        'pager'        => [
            'linkOptions' => ["data-load" => "#dashboard-list"],
        ],
        'emptyText'    => '<div class="text-center" style="margin-top: 120px;"><i class="fa fa-bookmark-o" style="font-size: 40px"></i><h3>' . Yii::t('app', 'no result found') . '</h3></div>',
    ]) ?>
<?php endif;?>
</div>
