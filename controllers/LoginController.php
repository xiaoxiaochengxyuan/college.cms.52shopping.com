<?php
namespace app\controllers;
use app\base\BaseWebController;
/**
 * 用户登录Controller
 * @author xiawei
 */
class LoginController extends BaseWebController {
	/**
	 * 用户登录
	 */
	public function actionIndex() {
		return $this->renderPartial('index');
	}
}