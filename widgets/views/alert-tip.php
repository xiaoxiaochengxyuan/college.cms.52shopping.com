<?php if (!empty($view->params['succ'])):?>
	<?php foreach ($view->params['succ'] as $succMsg):?>
		<div class="alert alert-success"><b>成功!</b> <?=$succMsg?>.</div>
	<?php endforeach;?>
<?php endif;?>

<?php if (!empty($view->params['warn'])):?>
	<?php foreach ($view->params['warn'] as $warnMsg):?>
		<div class="alert alert-warning"><b>警告!</b> <?=$warnMsg?>.</div>
	<?php endforeach;?>
<?php endif;?>

<?php if (!empty($view->params['err'])):?>
	<?php foreach ($view->params['err'] as $errMsg):?>
		<div class="alert alert-danger"><b>错误!</b> <?=$errMsg?>.</div>
	<?php endforeach;?>
<?php endif;?>