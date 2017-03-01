<?php
namespace app\filters;
use yii\base\ActionFilter;
use app\daos\CollegeAdmin;
/**
 * 用户登录Filter
 * @author xiawei
 */
class LoginFilter extends ActionFilter {
	/**
	 * {@inheritDoc}
	 * @see \yii\base\ActionFilter::beforeAction()
	 */
	public function beforeAction($action) {
		$actionId = $action->id;
		$controllerId = $action->controller->id;
		$noLogin = \Yii::$app->params['noLogin'];
		if ((isset($noLogin[$controllerId]) && ($noLogin[$controllerId] == '*' || in_array($actionId, $noLogin[$controllerId]))) || CollegeAdmin::isLogin()) {
			return parent::beforeAction($action);
		}
		\Yii::$app->response->redirect(['/login']);
		return !parent::beforeAction($action);
	}
}