<?php
use yii\widgets\ActiveForm;
use app\widgets\AlertTipWidget;
use yii\helpers\Html;
use app\widgets\ErrorTipWidget;
use app\utils\OssUtil;
?>
<!-- 引入uploadify -->
<?=$this->render('/includes/uploadify')?>
<script type="text/javascript">
$(function(){
	$("#image_url").uploadify({
		'swf': '<?=UPLOADIFY_STATIC_URL?>/uploadify.swf',
		'uploader':'<?=Yii::$app->urlManager->createUrl('common/upload-img')?>',
		'fileTypeExts' : '*.gif; *.jpg; *.png',
        'multi': false,
        'method': 'post',
        'buttonText': "选择轮播图片",
        'onUploadSuccess': function (file, data, response) {
	        var res = eval('(' + data + ')');
	        var image = "<img src='" + res.url + "' style='width:200px;'/>";
	        $("#image_url_input").val(res.fileName);
	        $("#carousel_imge").html(image);
        },
        'onUploadError' : function(file,errorCode,errorMsg,errorString,swfuploadifyQueue) {
	        alert('上传图片失败');
        },
        'auto': true
	});
});
</script>
<div class="form-panel">
	<h4 class="mb">
		<i class="fa fa-angle-right"></i> <?=$this->title?>
	</h4>
	<?=AlertTipWidget::widget(['view' => $this])?>
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal style-form']])?>
		<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label" style="text-align: right;">对应Url：</label>
			<div class="col-sm-7">
				<?=Html::textInput('CollegeCarouselForm[url]', $collegeCarouselForm->url, ['class' => 'form-control', 'placeholder' => '对应的url'])?>
			</div>
			<div class="col-sm-3">
				<?=ErrorTipWidget::widget(['form' => $collegeCarouselForm, 'attribute' => 'url'])?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label" style="text-align: right;">是否启用：</label>
			<div class="col-sm-7">
				<?=Html::dropDownList('CollegeCarouselForm[enabled]', $collegeCarouselForm->enabled, [1 => '是', 2 => '否'], ['class' => 'form-control'])?>
			</div>
			<div class="col-sm-3">
				<?=ErrorTipWidget::widget(['form' => $collegeCarouselForm, 'attribute' => 'enabled'])?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label" style="text-align: right;">轮播图片：</label>
			<div class="col-sm-7">
				<?=Html::fileInput('image_url', null, ['id' => 'image_url'])?>
				<?=Html::hiddenInput('CollegeCarouselForm[image_url]', $collegeCarouselForm->image_url, ['id' => 'image_url_input'])?>
			</div>
			<div class="col-sm-3">
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label" style="text-align: right;"></label>
			<div class="col-sm-7" id="carousel_imge">
				<?php if (!empty($collegeCarouselForm->image_url)):?>
					<img src='<?=OssUtil::getOssImg($collegeCarouselForm->image_url)?>' style='width:200px;'/>
				<?php endif;?>
			</div>
			<div class="col-sm-3">
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