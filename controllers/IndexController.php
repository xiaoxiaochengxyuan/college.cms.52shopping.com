<?php
namespace app\controllers;
use app\base\BaseWebController;
/**
 * 首页控制器
 * @author xiawei
 */
class IndexController extends BaseWebController {
	/**
	 * 首页控制器
	 */
	public function actionIndex() {
		$this->view->title = '首页';
		return $this->render('index');
	}
}