<?php
use app\utils\OssUtil;
use yii\widgets\LinkPager;
?>
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
					<th>所在分类</th>
					<th>标题图片</th>
					<th>商品价格</th>
					<th>库存</th>
					<th>显示购买人数</th>
					<th>实际购买人数</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($collegeProducts as $collegeProduct):?>
					<tr>
						<td><?=$collegeProduct['id']?></td>
						<td><?=$collegeProduct['name']?></td>
						<td><?="{$collegeProduct['tpc_name']} - {$collegeProduct['pc_name']}"?></td>
						<td><img src="<?=OssUtil::getOssImg($collegeProduct['title_img'])?>" alt="标题图片" style="width:100px;"/></td>
						<td><?=$collegeProduct['price']?></td>
						<td><?=$collegeProduct['college_product_number']?></td>
						<td><?=$collegeProduct['college_product_show_by_number']?></td>
						<td><?=$collegeProduct['buy_number']?></td>
						<td>
							<a href="<?=Yii::$app->getUrlManager()->createUrl(['/college-product/update', 'id' => $collegeProduct['id']])?>" class="btn btn-xs btn-success">编辑</a>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<center><?=LinkPager::widget(['pagination' => $pagination,]);?></center>
	</section>
</div>