<?php
use app\widgets\NavWidget;
use yii\base\Widget;
use app\daos\College;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?=$this->title?></title>
		<!-- Bootstrap core CSS -->
		<link href="<?=DASHGUM_CSS_STATIC_URL?>/bootstrap.css" rel="stylesheet">
		<!--external css-->
		<link href="<?=DASHGUM_STATIC_URL?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?=DASHGUM_CSS_STATIC_URL?>/zabuto_calendar.css">
		<link rel="stylesheet" type="text/css" href="<?=DASHGUM_JS_STATIC_URL?>/gritter/css/jquery.gritter.css" />
		<link rel="stylesheet" type="text/css" href="<?=DASHGUM_STATIC_URL?>/lineicons/style.css">
		<!-- Custom styles for this template -->
		<link href="<?=DASHGUM_CSS_STATIC_URL?>/style.css" rel="stylesheet">
		<link href="<?=DASHGUM_CSS_STATIC_URL?>/style-responsive.css" rel="stylesheet">
		<script src="<?=DASHGUM_JS_STATIC_URL?>/chart-master/Chart.js"></script>
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- js placed at the end of the document so the pages load faster -->
		<script src="<?=DASHGUM_JS_STATIC_URL?>/jquery.js"></script>
		<script src="<?=DASHGUM_JS_STATIC_URL?>/jquery-1.8.3.min.js"></script>
		<script src="<?=DASHGUM_JS_STATIC_URL?>/bootstrap.min.js"></script>
		<script class="include" type="text/javascript" src="<?=DASHGUM_JS_STATIC_URL?>/jquery.dcjqaccordion.2.7.js"></script>
		<script src="<?=DASHGUM_JS_STATIC_URL?>/jquery.scrollTo.min.js"></script>
		<script src="<?=DASHGUM_JS_STATIC_URL?>/jquery.nicescroll.js" type="text/javascript"></script>
		<script src="<?=DASHGUM_JS_STATIC_URL?>/jquery.sparkline.js"></script>
		
		<!--common script for all pages-->
		<script src="<?=DASHGUM_JS_STATIC_URL?>/common-scripts.js"></script>
	
		<script type="text/javascript" src="<?=DASHGUM_JS_STATIC_URL?>/gritter/js/jquery.gritter.js"></script>
		<script type="text/javascript" src="<?=DASHGUM_JS_STATIC_URL?>/gritter-conf.js"></script>
	
		<!--script for this page-->
		<script src="<?=DASHGUM_JS_STATIC_URL?>/sparkline-chart.js"></script>
		<script src="<?=DASHGUM_JS_STATIC_URL?>/zabuto_calendar.js"></script>
	</head>
	<body>
		<section id="container">
			<header class="header black-bg">
				<div class="sidebar-toggle-box">
					<div class="fa fa-bars tooltips" data-placement="right"
						data-original-title="Toggle Navigation"></div>
				</div>
				<!--logo start-->
				<a href="<?=Yii::$app->getUrlManager()->createUrl(['/'])?>" class="logo"><b>大学管理系统</b></a>
				<!--logo end-->
				<div class="nav notify-row" id="top_menu">
					<!--  notification start -->
					<ul class="nav top-menu">
						<!-- settings start -->
						<li id="header_inbox_bar" class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
								<i class="fa fa-envelope-o"></i>
								<span class="badge bg-theme">5</span>
							</a>
							<ul class="dropdown-menu extended inbox">
								<div class="notify-arrow notify-arrow-green"></div>
								<li>
									<p class="green">You have 5 new messages</p>
								</li>
								<li>
									<a href="index.html#">
										<span class="photo">
											<img alt="avatar" src="<?=DASHGUM_IMG_STATIC_URL?>/ui-zac.jpg">
										</span>
										<span class="subject">
											<span class="from">Zac Snider</span>
											<span class="time">Just now</span>
										</span>
										<span class="message"> Hi mate, how is everything?</span>
									</a>
								</li>
								<li>
									<a href="index.html#">
										<span class="photo">
											<img alt="avatar" src="<?=DASHGUM_IMG_STATIC_URL?>/ui-divya.jpg">
										</span>
										<span class="subject">
											<span class="from">Divya Manian</span>
											<span class="time">40 mins.</span>
										</span>
										<span class="message"> Hi, I need your help with this. </span>
									</a>
								</li>
								<li>
									<a href="index.html#">
										<span class="photo">
											<img alt="avatar" src="<?=DASHGUM_IMG_STATIC_URL?>/ui-danro.jpg">
										</span>
										<span class="subject">
											<span class="from">Dan Rogers</span>
											<span class="time">2 hrs.</span>
										</span>
										<span class="message"> Love your new Dashboard. </span>
									</a>
								</li>
								<li>
									<a href="index.html#">
										<span class="photo">
											<img alt="avatar" src="<?=DASHGUM_IMG_STATIC_URL?>/ui-sherman.jpg">
										</span>
										<span class="subject">
											<span class="from">Dj Sherman</span>
											<span class="time">4 hrs.</span>
										</span>
										<span class="message"> Please, answer asap. </span>
									</a>
								</li>
								<li><a href="index.html#">See all messages</a></li>
							</ul></li>
						<!-- inbox dropdown end -->
					</ul>
					<!--  notification end -->
				</div>
				
				<div class="top-menu">
					<ul class="nav pull-right top-menu">
						<li><a class="logout" href="<?=Yii::$app->urlManager->createUrl(['/login/logout'])?>">退出系统</a></li>
					</ul>
				</div>
				
				<div class="top-menu">
					<ul class="nav pull-right top-menu">
						<li><a class="logout" href="<?=Yii::$app->urlManager->createUrl(['/college-admin/chgpasswd'])?>">修改密码</a></li>
					</ul>
				</div>
			</header>
			<aside>
				<div id="sidebar" class="nav-collapse ">
					<!-- sidebar menu start-->
					<ul class="sidebar-menu" id="nav-accordion">
						<p class="centered">
							<a href="<?=Yii::$app->urlManager->createUrl('/')?>">
								<img src="<?=DASHGUM_IMG_STATIC_URL?>/ui-sam.jpg" class="img-circle" width="60">
							</a>
						</p>
						<h5 class="centered"><?=College::instance()->getCurrentLoginCollege('name')?></h5>
						<?=NavWidget::widget(['view' => $this])?>
					</ul>
				</div>
			</aside>
			<section id="main-content">
				<section class="wrapper">
					<h3><i class="fa fa-angle-right"></i> <?=$this->title?></h3>
					<?=$content?>
				</section>
			</section>
	
			<!--main content end-->
			<!--footer start-->
			<footer class="site-footer">
				<div class="text-center">
					<?=date('Y')?> - 52scshopping@xiawei <a href="javascript:void(0)" class="go-top"> <i class="fa fa-angle-up"></i></a>
				</div>
			</footer>
			<!--footer end-->
		</section>
		
		<script type="application/javascript">
		$(function () {
			$("#date-popover").popover({html: true, trigger: "manual"});
			$("#date-popover").hide();
			$("#date-popover").click(function (e) {
				$(this).hide();
			});
	
				$("#my-calendar").zabuto_calendar({
					action: function () {
						return myDateFunction(this.id, false);
					},
					action_nav: function () {
						return myNavFunction(this.id);
					},
					ajax: {
						url: "show_data.php?action=1",
						modal: true
					},
					legend: [
					{type: "text", label: "Special event", badge: "00"},
					{type: "block", label: "Regular event", }
					]
				});
		});
		function myNavFunction(id) {
			$("#date-popover").hide();
			var nav = $("#" + id).data("navigation");
			var to = $("#" + id).data("to");
			console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
		}
		</script>
	</body>
</html>
