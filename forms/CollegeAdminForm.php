<?php
namespace app\forms;
use yii\base\Model;
/**
 * 大学管理员Form表单
 * @author xiawei
 */
class CollegeAdminForm extends Model {
	/**
	 * 用户名
	 * @var string
	 */
	public $username = null;
	
	/**
	 * 密码
	 * @var string
	 */
	public $password = null;
	
	/**
	 * 验证码
	 * @var unknown
	 */
	public $verify = null;
}