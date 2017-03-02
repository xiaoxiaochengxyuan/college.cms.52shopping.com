<?php 
function activeLi($controllerId) {
	return Yii::$app->controller->id == $controllerId ? 'class="active"' : '';
}
?>
<li class="mt">
	<a <?=activeLi('index')?> href="<?=Yii::$app->urlManager->createUrl('/')?>">
		<i class="fa fa-dashboard"></i>
		<span>欢迎页面</span>
	</a>
</li>