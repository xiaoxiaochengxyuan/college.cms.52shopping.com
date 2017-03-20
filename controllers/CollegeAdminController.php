<?php
namespace app\controllers;
use app\base\BaseWebController;
use app\forms\CollegeAdminForm;
use app\daos\CollegeAdmin;
/**
 * 大学管理员Controller
 * @author xiawei
 */
class CollegeAdminController extends BaseWebController {
	/**
	 * 修改密码
	 */
	public function actionChgpasswd(){
		$collegeAdminForm = new CollegeAdminForm();
		$collegeAdminForm->setScenario('chgpasswd');
		if (\Yii::$app->request->getIsPost()) {
			$post = \Yii::$app->request->post('CollegeAdminForm');
			$collegeAdminForm->setAttributes($post, false);
			if ($collegeAdminForm->validate() && CollegeAdmin::instance()->chgLoginPasswd($post['newPassword'])) {
				$this->addSuccMsg('修改密码成功');
			}
		}
		$this->view->title = '修改密码';
		return $this->render('chgpasswd', ['collegeAdminForm' => $collegeAdminForm]);
	}
}