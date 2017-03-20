<?php 
function activeLi($controllerId, $actionId = null) {
	if (empty($actionId)) {
		return Yii::$app->controller->id == $controllerId ? 'class="active"' : '';
	}
	return Yii::$app->controller->id == $controllerId && Yii::$app->controller->action->id == $actionId ? 'class="active"' : '';
}
?>
<li class="mt">
	<a <?=activeLi('index')?> href="<?=Yii::$app->getUrlManager()->createUrl('/')?>">
		<i class="fa fa-dashboard"></i>
		<span>欢迎页面</span>
	</a>
</li>
<li class="dcjq-parent-li">
	<a <?=activeLi('college-dorm-area-product')?> href="<?=Yii::$app->getUrlManager()->createUrl('/college-dorm-area-product')?>">
		<i class="glyphicon glyphicon-glass"></i>
		<span>商品列表</span>
	</a>
</li>
<li class="dcjq-parent-li">
	<a <?=activeLi('college-carousel')?> href="<?=Yii::$app->getUrlManager()->createUrl('/college-carousel')?>">
		<i class="glyphicon glyphicon-th-large"></i>
		<span>轮播列表</span>
	</a>
</li>
<li class="dcjq-parent-li">
	<a <?=activeLi('message')?> href="<?=Yii::$app->getUrlManager()->createUrl(['/message'])?>">
		<i class="glyphicon glyphicon-comment"></i>
		<span>消息列表</span>
	</a>
</li>