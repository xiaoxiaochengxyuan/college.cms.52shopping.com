<?php
use app\utils\OssUtil;
?>
<script type="text/javascript">
function changeEnabled(id, text) {
	if(confirm("您真的要" + text + "该轮播图吗？")) {
		$.get("<?=Yii::$app->getUrlManager()->createUrl('/college-carousel/change-enabled')?>", {
			'id' : id
		}, function(response) {
			if(response.code == <?=ERROR_CODE_NONE?>) {
				window.location.reload();
			} else {
				alert(response.msg);
			}
		});
	}
}


function upCarousel(id) {
	if(confirm("您真的要上移该轮播图吗？")) {
		$.get("<?=Yii::$app->getUrlManager()->createUrl('/college-carousel/up')?>", {
			"id" : id
		}, function(response) {
			if(response.code == <?=ERROR_CODE_NONE?>) {
				window.location.reload();
			} else {
				alert(response.msg);
			}
		});
	}
}


function downCarousel(id) {
	if(confirm("您真的要下移该轮播图吗？")) {
		$.get("<?=Yii::$app->getUrlManager()->createUrl('/college-carousel/down')?>", {
			"id" : id
		}, function(response) {
			if(response.code == <?=ERROR_CODE_NONE?>) {
				window.location.reload();
			} else {
				alert(response.msg);
			}
		});
	}
}


function deleteCarousel(id) {
	if(confirm("您真的要删除该轮播图吗？")) {
		$.get("<?=Yii::$app->getUrlManager()->createUrl('/college-carousel/delete')?>", {
			"id" : id
		}, function(response) {
			if(response.code == <?=ERROR_CODE_NONE?>) {
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
		<a class="btn btn-info btn-xs" style="float: right; margin-right: 20px;" href="<?=Yii::$app->getUrlManager()->createUrl(['/college-carousel/add'])?>">添加</a>
	</h4>
	<section id="unseen">
		<table class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th>ID</th>
					<th>对应链接</th>
					<th>图片</th>
					<th>是否可用</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($collegeCarousels as $collegeCarousel):?>
					<tr>
						<td><?=$collegeCarousel['id']?></td>
						<td><a href="<?=$collegeCarousel['url']?>" target="_blank"><?=$collegeCarousel['url']?></a></td>
						<td><img alt="轮播图" src="<?=OssUtil::getOssImg($collegeCarousel['image_url'])?>" style="width: 200px;"></td>
						<td><?=$collegeCarousel['enabled'] == 1 ? '<font color="green">是</font>' : '<font color="red">否</font>'?></td>
						<td>
							<?php if ($collegeCarousel['enabled'] == 1):?>
								<button class="btn btn-danger btn-xs" onclick="changeEnabled(<?=$collegeCarousel['id']?>, '禁用')">禁用</button>
							<?php else:?>
								<button class="btn btn-success btn-xs" onclick="changeEnabled(<?=$collegeCarousel['id']?>, '启用')">启用</button>
							<?php endif;?>
							<button class="btn btn-xs btn-warning" onclick="upCarousel(<?=$collegeCarousel['id']?>)">上移</button>
							<button class="btn btn-xs btn-success" onclick="downCarousel(<?=$collegeCarousel['id']?>)">下移</button>
							<a href="<?=Yii::$app->getUrlManager()->createUrl(['/college-carousel/update', 'id' => $collegeCarousel['id']])?>" class="btn btn-xs btn-info">修改</a>
							<button class="btn btn-danger btn-xs" onclick="deleteCarousel(<?=$collegeCarousel['id']?>)">删除</button>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</section>
</div>