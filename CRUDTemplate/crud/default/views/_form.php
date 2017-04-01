<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
	$safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use jackh\material\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?=ltrim($generator->modelClass, '\\')?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?=$generator->enablePjax ? 'modal-body ' : ''?><?=Inflector::camel2id(StringHelper::basename($generator->modelClass))?>-form">

    <?="<?php "?>$form = ActiveForm::begin(); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
	if (in_array($attribute, $safeAttributes)) {
		echo "    <div class=\"col-xs-6 col-sm-2\">\n";
		echo "        <?= " . $generator->generateActiveField($attribute) . " ?>\n";
		echo "    </div>\n\n";
	}
}?>

	<footer class="col-sm-12 footer animated fadeInUp delay-05">
		<div class="pull-right">
			<?="<?= "?>Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Create' : 'Update'), ['class' => 'btn btn-primary'])?>
		</div>
	</footer>

    <?="<?php "?>ActiveForm::end(); ?>

</div>
