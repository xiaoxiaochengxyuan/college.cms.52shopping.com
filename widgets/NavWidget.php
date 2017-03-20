<?php
namespace app\widgets;
use yii\base\Widget;
use yii\web\View;
/**
 * 导航对应的Widget
 * @author xiawei
 */
class NavWidget extends Widget {
	/**
	 * {@inheritDoc}
	 * @see \yii\base\Widget::run()
	 */
	public function run() {
		return $this->render('nav', ['view' => $this->view]);
	}
}