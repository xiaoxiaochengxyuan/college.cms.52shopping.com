<?php use yii\helpers\Html;?>
<?php if ($form->hasErrors($attribute)):?>
	<label class="control-label" style="color: red;"><?=Html::error($form, $attribute)?></label>
<?php endif;?>