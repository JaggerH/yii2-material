<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?=ltrim($generator->searchModelClass, '\\')?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?=Inflector::camel2id(StringHelper::basename($generator->modelClass))?>-search col-xs-12 row">

    <?="<?php "?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-load' => '#dashboard-list',
        ],
    ]); ?>

<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    echo '    <div class="col-sm-2">' . "\n";
    if (++$count < 6) {
        echo "    <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n";
    } else {
        echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n";
    }
    echo '    </div>' . "\n\n";
}
?>

    <div class="form-group row col-xs-12 text-center">
        <?="<?= "?>Html::submitButton(<?=$generator->generateString('Search')?>, ['class' => 'btn btn-primary']) ?>
        <?="<?= "?>Html::resetButton("重置", ['class' => 'btn btn-default']) ?>
    </div>

    <?="<?php "?>ActiveForm::end(); ?>

</div>
