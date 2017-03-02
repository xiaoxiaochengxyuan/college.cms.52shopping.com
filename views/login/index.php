<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>52scshopping - 大学管理员登录</title>
		<!-- Bootstrap core CSS -->
		<link href="<?=DASHGUM_CSS_STATIC_URL?>/bootstrap.css" rel="stylesheet">
		<!--external css-->
		<link href="<?=DASHGUM_STATIC_URL?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<!-- Custom styles for this template -->
		<link href="<?=DASHGUM_CSS_STATIC_URL?>/style.css" rel="stylesheet">
		<link href="<?=DASHGUM_CSS_STATIC_URL?>/style-responsive.css" rel="stylesheet">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- js placed at the end of the document so the pages load faster -->
		<script src="<?=DASHGUM_JS_STATIC_URL?>/jquery.js"></script>
		<script src="<?=DASHGUM_JS_STATIC_URL?>/bootstrap.min.js"></script>
	
		<!--BACKSTRETCH-->
		<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
		<script type="text/javascript" src="<?=DASHGUM_JS_STATIC_URL?>/jquery.backstretch.min.js"></script>
		<style type="text/css">
		#vimg:HOVER {
			cursor: pointer;
		}
		#vimg {
			border: 1px solid #ccc;
		}
		div.error-info {
			background: #C9302C;
			color: white;
			border:1px solid #ccc;
			padding: 4px 0 4px 10px;
		}
		div.input-div {
			margin: 8px 0;
		}
		</style>
		<script>
	        $(function(){
	        	$.backstretch("<?=DASHGUM_IMG_STATIC_URL?>/login-bg.jpg", {speed: 500});
	        	//点击验证码变化
	        	$('#vimg').click(function(){
		        	var date = new Date();
		        	var url = '<?=Yii::$app->urlManager->createUrl(['common/verify', 'len' => 5, 'iw' => 290, 'ih' => 30])?>&rand=' + date.getTime();
	        		$('#vimg').attr('src', url);
		        });
		    });
	    </script>
	</head>
	<body>
		<div id="login-page">
			<div class="container">
				<?php $form=ActiveForm::begin(['options' => ['class' => 'form-login']])?>
					<h2 class="form-login-heading">大学管理员登录</h2>
					<div class="login-wrap">
						<div class="input-div" style="margin-top: 0;"><?=Html::textInput('CollegeAdminForm[username]', $collegeAdminForm->username, ['class' => 'form-control', 'placeholder' => '用户名'])?></div>
						<?php if ($collegeAdminForm->hasErrors('username')):?>
							<div class="error-info"><?=Html::error($collegeAdminForm, 'username')?></div>
						<?php endif;?>
						<div class="input-div"><?=Html::passwordInput('CollegeAdminForm[password]', $collegeAdminForm->password, ['class' => 'form-control', 'placeholder' => '密码'])?></div>
						<?php if ($collegeAdminForm->hasErrors('password')):?>
							<div class="error-info"><?=Html::error($collegeAdminForm, 'password')?></div>
						<?php endif;?>
						<div class="input-div"><?=Html::textInput('CollegeAdminForm[verify]', $collegeAdminForm->verify, ['class' => 'form-control', 'placeholder' => '验证码'])?></div>
						<?php if ($collegeAdminForm->hasErrors('verify')):?>
							<div class="error-info" style="margin-bottom: 6px;"><?=Html::error($collegeAdminForm, 'verify')?></div>
						<?php endif;?>
						<img id="vimg" alt="验证码,点击刷新" src="<?=Yii::$app->urlManager->createUrl(['common/verify', 'len' => 5, 'iw' => 288, 'ih' => 30])?>"><br/><br/>
						<button class="btn btn-theme btn-block" type="submit">
							<i class="fa fa-lock"></i> 登录
						</button>
					</div>
				<?php ActiveForm::end()?>
			</div>
		</div>
	</body>
</html>
