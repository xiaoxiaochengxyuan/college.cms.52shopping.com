<?php
namespace app\controllers;
use app\base\BaseWebController;
/**
 * 消息相关的Controller
 * @author xiawei
 */
class MessageController extends BaseWebController {
	/**
	 * 消息列表
	 * @return string
	 */
	public function actionIndex() {
		$this->view->title = '消息列表';
		return $this->render('index');
	}
}