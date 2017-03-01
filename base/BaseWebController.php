<?php
namespace app\base;
use yii\web\Controller;
/**
 * 所以Controller的基类
 * @author xiawei
 */
abstract class BaseWebController extends Controller {
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