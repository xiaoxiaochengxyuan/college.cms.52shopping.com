<?php
namespace app\forms;
use yii\base\Model;
use app\daos\CollegeAdmin;
use app\utils\StringUtil;
use app\utils\VerifyUtil;
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
	
	/**
	 * {@inheritDoc}
	 * @see \yii\base\Model::rules()
	 */
	public function rules() {
		return [
			['username', 'required', 'on' => ['login'], 'message' => '用户名必须填写'],
			['password', 'required', 'on' => ['login'], 'message' => '密码必须填写'],
			['verify', 'checkVerify', 'on' => ['login'], 'skipOnEmpty' => false],
		];
	}
	
	/**
	 * 用户登录
	 * @return boolean
	 */
	public function login() {
		if (!$this->hasErrors()) {
			$collegeAdmin = CollegeAdmin::instance()->getByColumn('username', $this->username);
			if (empty($collegeAdmin)) {
				$this->addError('username', '用户名错误');
			} elseif (StringUtil::genPassword($this->password, $collegeAdmin['salt']) != $collegeAdmin['password']) {
				$this->addError('password', '密码错误');
			} else {
				CollegeAdmin::login($collegeAdmin);
			}
		}
		return !$this->hasErrors();
	}
	
	
	public function checkVerify() {
		if (empty($this->verify)) {
			$this->addError('verify', '验证码不能为空');
		}
	}
}