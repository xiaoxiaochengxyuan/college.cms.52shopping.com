<?php
namespace app\forms;
use yii\base\Model;
/**
 * 大学轮播图Form
 * @author xiawei
 */
class CollegeCarouselForm extends Model {
	/**
	 * 自增Id
	 * @var integer
	 */
	public $id = 0;
	
	/**
	 * 对应的图片Url
	 * @var string
	 */
	public $image_url = null;
	
	/**
	 * 对应的url
	 * @var string
	 */
	public $url = null;
	
	
	/**
	 * 是否启用
	 * @var integer
	 */
	public $enabled = 1;
	
	/**
	 * {@inheritDoc}
	 * @see \yii\base\Model::rules()
	 */
	public function rules() {
		return [
			['image_url', 'required', 'on' => ['add', 'update'], 'message' => '必须上传图片'],
			['url', 'url', 'on' => ['add', 'update'], 'skipOnEmpty' => false, 'message' => '对应url错误'],
		];
	}
}