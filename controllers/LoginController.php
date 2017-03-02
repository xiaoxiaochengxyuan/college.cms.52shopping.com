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
		if (\Yii::$app->request->getIsPost()) {
			$post = \Yii::$app->request->post('CollegeAdminForm');
			$collegeAdminForm->setAttributes($post, false);
			if ($collegeAdminForm->validate()) {
				$this->redirect(['/']);
			}
		}
		return $this->renderPartial('index', ['collegeAdminForm' => $collegeAdminForm]);
	}
}