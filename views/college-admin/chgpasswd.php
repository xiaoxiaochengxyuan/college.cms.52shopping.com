<?php
use yii\helpers\Html;
use app\widgets\ErrorTipWidget;
use yii\base\Widget;
use yii\widgets\ActiveForm;
use app\widgets\AlertTipWidget;
?>
<div class="form-panel">
	<h4 class="mb">
		<i class="fa fa-angle-right"></i> <?=$this->title?>
	</h4>
	<?=AlertTipWidget::widget(['view' => $this])?>
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal style-form']])?>
		<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label" style="text-align: right;">旧密码</label>
			<div class="col-sm-7">
				<?=Html::passwordInput('CollegeAdminForm[password]', $collegeAdminForm->password, ['class' => 'form-control', 'placeholder' => '旧密码'])?>
			</div>
			<div class="col-sm-3">
				<?=ErrorTipWidget::widget(['form' => $collegeAdminForm, 'attribute' => 'password'])?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label" style="text-align: right;">新密码</label>
			<div class="col-sm-7">
				<?=Html::passwordInput('CollegeAdminForm[newPassword]', $collegeAdminForm->newPassword, ['class' => 'form-control', 'placeholder' => '新密码'])?>
			</div>
			<div class="col-sm-3">
				<?=ErrorTipWidget::widget(['form' => $collegeAdminForm, 'attribute' => 'newPassword'])?>
			</div>
		</div>
		
		
		<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label" style="text-align: right;">重复密码</label>
			<div class="col-sm-7">
				<?=Html::passwordInput('CollegeAdminForm[rePassword]', $collegeAdminForm->rePassword, ['class' => 'form-control', 'placeholder' => '重复密码'])?>
			</div>
			<div class="col-sm-3">
				<?=ErrorTipWidget::widget(['form' => $collegeAdminForm, 'attribute' => 'rePassword'])?>
			</div>
		</div>
		<div class="form-group">
			<center>
				<button type="submit" class="btn btn-theme03">提交</button>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="reset" class="btn btn-theme02">重置</button>
			</center>
		</div>
	<?php ActiveForm::end()?>
</div>