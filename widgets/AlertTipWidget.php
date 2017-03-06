<?php
namespace app\widgets;
use yii\base\Widget;
/**
 * 提示信息Widget
 * @author xiawei
 */
class AlertTipWidget extends Widget {
	/**
	 * 对应的模板
	 * @var View
	 */
	public $view = null;
	
	/**
	 * {@inheritDoc}
	 * @see \yii\base\Widget::run()
	 */
	public function run() {
		return $this->render('alert-tip', ['view' => $this->view]);
	}
}