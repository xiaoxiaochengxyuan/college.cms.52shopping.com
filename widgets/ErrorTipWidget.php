<?php
namespace app\widgets;
use yii\base\Widget;
use yii\base\Model;
/**
 * 错误提示信息相关的小物件
 * @author xiawei
 */
class ErrorTipWidget extends Widget {
	/**
	 * 对应的Form组件
	 * @var Model
	 */
	public $form = null;
	/**
	 * 对应的字段属性名称
	 * @var string
	 */
	public $attribute = null;
	
	/**
	 * {@inheritDoc}
	 * @see \yii\base\Widget::run()
	 */
	public function run() {
		return $this->render('error-tip', ['form' => $this->form, 'attribute' => $this->attribute]);
	}
}