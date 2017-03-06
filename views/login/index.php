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
		<style type="text/css">
		div.login-input {
			margin: 6px 0;
		}
		div.login-err {
			border: 1px solid #ccc;
			padding: 4px 3px;
			background: #DA4453;
			color: white;
			border-radius: 6px;
		}
		</style>
	</head>
	<body>
		<div id="login-page">
			<div class="container">
				<?php $form=ActiveForm::begin(['options' => ['class' => 'form-login']])?>
					<h2 class="form-login-heading">大学管理员登录</h2>
					<div class="login-wrap">
						<div class="login-input" style="margin-top: 0;"><?=Html::textInput('CollegeAdminForm[username]', $collegeAdminForm->username, ['class' => 'form-control', 'placeholder' => '用户名'])?></div>
						<?php if ($collegeAdminForm->hasErrors('username')):?>
							<div class="login-input login-err"><?=Html::error($collegeAdminForm, 'username')?></div>
						<?php endif;?>
						<div class="login-input"><?=Html::passwordInput('CollegeAdminForm[password]', $collegeAdminForm->password, ['class' => 'form-control', 'placeholder' => '密码'])?></div>
						<?php if ($collegeAdminForm->hasErrors('password')):?>
							<div class="login-input login-err"><?=Html::error($collegeAdminForm, 'password')?></div>
						<?php endif;?>
						<button class="btn btn-theme btn-block" type="submit">
							<i class="fa fa-lock"></i> 登录
						</button>
					</div>
				<?php ActiveForm::end()?>
			</div>
		</div>
		<!-- js placed at the end of the document so the pages load faster -->
		<script src="<?=DASHGUM_JS_STATIC_URL?>/jquery.js"></script>
		<script src="<?=DASHGUM_JS_STATIC_URL?>/bootstrap.min.js"></script>
	
		<!--BACKSTRETCH-->
		<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
		<script type="text/javascript" src="<?=DASHGUM_JS_STATIC_URL?>/jquery.backstretch.min.js"></script>
		<script>
	        $.backstretch("<?=DASHGUM_IMG_STATIC_URL?>/login-bg.jpg", {speed: 500});
	    </script>
	</body>
</html>
