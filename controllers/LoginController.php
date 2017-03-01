<?php
namespace app\controllers;
use app\base\BaseWebController;
use app\forms\CollegeAdminForm;
/**
 * 用户登录Controller
 * @author xiawei
 */
class LoginController extends BaseWebController {
	/**
	 * 用户登录
	 */
	public function actionIndex() {
		$collegeAdminForm = new CollegeAdminForm();
		$collegeAdminForm->setScenario('login');
		return $this->renderPartial('index', ['collegeAdminForm' => $collegeAdminForm]);
	}
}