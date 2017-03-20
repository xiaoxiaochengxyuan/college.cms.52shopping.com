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
	 * 新密码
	 * @var string
	 */
	public $newPassword = null;
	
	/**
	 * 重复密码
	 * @var string
	 */
	public $rePassword = null;
	
	/**
	 * {@inheritDoc}
	 * @see \yii\base\Model::rules()
	 */
	public function rules() {
		return [
			['username', 'required', 'on' => ['login'], 'message' => '用户名必须填写'],
			['password', 'checkPassword', 'on' => ['login', 'chgpasswd'], 'skipOnEmpty' => false],
			['newPassword', 'checkNewPassword', 'on' => ['chgpasswd'], 'skipOnEmpty' => false],
			['rePassword', 'compare', 'compareAttribute' => 'newPassword', 'on' => ['chgpasswd'], 'skipOnEmpty' => false, 'message' => '重复密码和新密码不同']
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
	
	/**
	 * 检查密码
	 */
	public function checkPassword() {
		$passwordName = '密码';
		if ($this->getScenario() == 'chgpasswd') {
			$passwordName = '旧密码';
		}
		if (empty($this->password)) {
			$this->addError('password', "{$passwordName}不能为空");
		} elseif ($this->getScenario() == 'chgpasswd') {
			$currentCollegeAdmin = CollegeAdmin::instance()->getCurrentLogin();
			if ($currentCollegeAdmin['password'] != StringUtil::genPassword($this->password, $currentCollegeAdmin['salt'])) {
				$this->addError('password', "{$passwordName}错误");
			}
		}
	}
	
	
	/**
	 * 检查新密码
	 */
	public function checkNewPassword() {
		if (empty($this->newPassword)) {
			$this->addError('newPassword', '新密码错误');
		} elseif ($this->newPassword == $this->password) {
			$this->addError('newPassword', '新密码和旧密码相等');
		}
	}
}