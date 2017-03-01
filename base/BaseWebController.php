<?php
namespace app\base;
use yii\web\Controller;
/**
 * 所以Controller的基类
 * @author xiawei
 */
abstract class BaseWebController extends Controller {
	/**
	 * 定义一些模板中要使用的常量
	 */
	private function defineStatics() {
		defined('STATIC_URL') or define('STATIC_URL', \Yii::$app->urlManager->baseUrl.'/static');
		defined('DASHGUM_STATIC_URL') or define('DASHGUM_STATIC_URL', STATIC_URL.'/dashgum');
		defined('DASHGUM_CSS_STATIC_URL') or define('DASHGUM_CSS_STATIC_URL', DASHGUM_STATIC_URL.'/css');
		defined('DASHGUM_JS_STATIC_URL') or define('DASHGUM_JS_STATIC_URL', DASHGUM_STATIC_URL.'/js');
		defined('DASHGUM_IMG_STATIC_URL') or define('DASHGUM_IMG_STATIC_URL', DASHGUM_STATIC_URL.'/img');
	}
	
	/**
	 * {@inheritDoc}
	 * @see \yii\base\Controller::renderPartial()
	 */
	public function renderPartial($view, $params = []) {
		$this->defineStatics();
		return parent::renderPartial($view, $params);
	}
	
	
	public function render($view, $params = []) {
		$this->defineStatics();
		return parent::render($view, $params);
	}
	
	/**
	 * {@inheritDoc}
	 * @see \yii\base\Component::behaviors()
	 */
	public function behaviors() {
		return [[
			'class' => 'app\filters\LoginFilter',
		]];
	}
	
	/**
	 * 添加成功信息
	 * @param string $msg 成功信息
	 */
	protected function addSuccMsg($msg) {
		if (empty($this->view->params['succ'])) {
			$this->view->params['succ'] = [];
		}
		$this->view->params['succ'][] = $msg;
	}
	
	/**
	 * 添加警告信息
	 * @param string $msg
	 */
	protected function addWarnMsg($msg) {
		if (empty($this->view->params['warn'])) {
			$this->view->params['warn'] = [];
		}
		$this->view->params['warn'][] = $msg;
	}
	
	/**
	 * 添加错误信息
	 * @param string $msg
	 */
	protected function addErrMsg($msg) {
		if (empty($this->view->params['err'])) {
			$this->view->params['err'] = [];
		}
		$this->view->params['err'][] = $msg;
	}
}