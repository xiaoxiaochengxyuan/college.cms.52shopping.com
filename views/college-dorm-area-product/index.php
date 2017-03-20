<?php
use app\utils\OssUtil;
use yii\widgets\LinkPager;
?>
<script type="text/javascript">
function changeGroup(collegeDormAreaProductId, optionMsg) {
	if(confirm('您真的要' + optionMsg + '该商品吗？')) {
		$.get("<?=Yii::$app->getUrlManager()->createUrl(['/college-dorm-area-product/change-group'])?>", {
			"collegeDormAreaProductId" : collegeDormAreaProductId
		}, function(response) {
			if(response.code = <?=ERROR_CODE_NONE?>) {
				window.location.reload();
			} else {
				alert(response.msg);
			}
		});
	}
}


function getBasicInfo(collegeDormAreaProductId) {
	if(confirm('您真的要拉去该产品的基本信息吗？')) {
		//首先判断库存类型是否有改变
		$.get("<?=Yii::$app->getUrlManager()->createUrl(['/college-dorm-area-product/is-option-num-chged'])?>", {
			'id' : collegeDormAreaProductId
		}, function(response) {
			if(response) {
				if(confirm("产品库存类型有变化,请问您真的要拉取吗？")) {
					$.get("<?=Yii::$app->getUrlManager()->createUrl(['/college-dorm-area-product/reflash'])?>", {
						'id' : collegeDormAreaProductId
					}, function(response) {
						
					});
				}
			}
		});
	}
}


function chgJinpin(id, type) {
	var msg = type == 0 ? '取消精品' : '设为精品';
	if(confirm('您真的确定要把该商品' + msg + '吗？')) {
		$.get("<?php echo Yii::$app->getUrlManager()->createUrl(['/college-dorm-area-product/chg-jinpin'])?>", {
			'id' : id
		}, function(response){
			if(response.code == <?php echo ERROR_CODE_NONE?>) {
				window.location.reload();
			} else {
				alert(response.msg);
			}
		});
	}
}
</script>
<div class="content-panel">
	<h4>
		<i class="fa fa-angle-right"></i> <?=$this->title?>
	</h4>
	<section id="unseen">
		<table class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th>ID</th>
					<th>商品名称</th>
					<th>标题图片</th>
					<th>显示购买数</th>
					<th>实际购买数</th>
					<th>默认库存</th>
					<th>进价</th>
					<th>售价</th>
					<th>顶级分类</th>
					<th>二级分类</th>
					<th>是否系统上架</th>
					<th>是否上架</th>
					<th>是否是精品</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($collegeDormAreaProducts as $collegeDormAreaProduct):?>
					<tr>
						<td><?=$collegeDormAreaProduct['id']?></td>
						<td><?=$collegeDormAreaProduct['product_name']?></td>
						<td><img alt="标题图片" src="<?=OssUtil::getOssImg($collegeDormAreaProduct['product_title_img'])?>" style="width: 100px;"></td>
						<td><?=$collegeDormAreaProduct['show_buy_number']?></td>
						<td><?=$collegeDormAreaProduct['buy_number']?></td>
						<td><?=$collegeDormAreaProduct['num']?></td>
						<td><?=$collegeDormAreaProduct['stock_price']?></td>
						<td><?=$collegeDormAreaProduct['price']?></td>
						<td><?=$collegeDormAreaProduct['top_cat_name']?></td>
						<td><?=$collegeDormAreaProduct['cat_name']?></td>
						<td><?=$collegeDormAreaProduct['system_grounding'] == 1 ? '是' : '否'?></td>
						<td><?=$collegeDormAreaProduct['grounding'] == 1 ? '是' : '否'?></td>
						<td><?=$collegeDormAreaProduct['is_jinpin'] == 1 ? '<font color="green">是</font>' : '<font color="red">否</font>'?></td>
						<td>
							<?php if ($collegeDormAreaProduct['grounding'] == 1):?>
								<button class="btn btn-danger btn-xs" onclick="changeGroup(<?=$collegeDormAreaProduct['id']?>, '下架')">下架</button>
							<?php else:?>
								<button class="btn btn-info btn-xs" onclick="changeGroup(<?=$collegeDormAreaProduct['id']?>, '上架')">上架</button>
							<?php endif;?>
							<?php if ($collegeDormAreaProduct['is_jinpin'] == 1):?>
								<button class="btn btn-warning btn-xs" onclick="chgJinpin(<?=$collegeDormAreaProduct['id']?>, 0)">取消精品</button>
							<?php else:?>
								<button class="btn btn-xs btn-success" onclick="chgJinpin(<?=$collegeDormAreaProduct['id']?>, 1)">设为精品</button>
							<?php endif;?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<center><?=LinkPager::widget(['pagination' => $pagination,]);?></center>
	</section>
</div>