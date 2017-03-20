<?php
namespace app\daos;
use app\base\Dao;
use yii\helpers\Json;
use app\utils\StringUtil;
use yii\web\Cookie;
use yii\base\Exception;
/**
 * 大学管理员Dao
 * @author xiawei
 */
class CollegeAdmin extends Dao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'college_admin';
	
	const COLLEGE_ADMIN_COOKIE_KEY = 'college_admin_cookie_key';
	
	/**
	 * {@inheritDoc}
	 * @see \app\base\Dao::tableName()
	 */
	protected function tableName() {
		return self::TABLE_NAME;
	}
	
	/**
	 * 单例
	 * @param system $className
	 * @return CollegeAdmin
	 */
	public static function instance($className = __CLASS__) {
		return parent::instance($className);
	}
	
	/**
	 * 判断管理员是否登录
	 * @return boolean true表示已经登录,false表示没有登录
	 */
	public static function isLogin() {
		try {
			//从cookie中取出加密登录信息
			$collegeAdminCookie = \Yii::$app->request->getCookies()->getValue(self::COLLEGE_ADMIN_COOKIE_KEY);
			//把加密登录信息转化成为对应的数组
			$collegeAdmin = StringUtil::encryStrToData($collegeAdminCookie);
			return isset($collegeAdmin['id']) && isset($collegeAdmin['username']) && isset($collegeAdmin['college_dorm_area_id']);
		} catch (\Exception $e) {
			return false;
		}
		return false;
	}
	
	/**
	 * 登录
	 * @param array $collegeAdmin
	 */
	public static function login(array $collegeAdmin) {
		if (isset($collegeAdmin['password'])) {
			unset($collegeAdmin['password']);
		}
		if (isset($collegeAdmin['salt'])) {
			unset($collegeAdmin['salt']);
		}
		$collegeAdminJson = Json::encode($collegeAdmin);
		$collegeAdminCookie = StringUtil::encryStr($collegeAdminJson);
		$cookie = new Cookie(['name' => self::COLLEGE_ADMIN_COOKIE_KEY, 'value' => $collegeAdminCookie]);
		\Yii::$app->response->getCookies()->add($cookie);
	}
	
	/**
	 * 获取登录信息
	 * @param unknown $field
	 * @return mixed|NULL|NULL
	 */
	public static function loginInfo($field = null) {
		if (self::isLogin()) {
			try {
				$collegeAdminCookie = \Yii::$app->request->getCookies()->getValue(self::COLLEGE_ADMIN_COOKIE_KEY);
				$collegeAdminJson = StringUtil::decryStr($collegeAdminCookie);
				$collegeAdmin = Json::decode($collegeAdminJson);
				if (empty($field)) {
					return $collegeAdmin;
				}
				if (!isset($collegeAdmin[$field])) {
					return null;
				}
				return $collegeAdmin[$field];
			} catch (\Exception $e) {
				return null;
			}
		}
		return null;
	}
	
	/**
	 * 退出系统
	 */
	public static function logout() {
		\Yii::$app->response->getCookies()->remove(self::COLLEGE_ADMIN_COOKIE_KEY);
	}
	
	
	/**
	 * 修改当前登录用户密码
	 * @param string $password 要修改成的密码
	 * @throws Exception 没有用户登录抛出异常
	 * @return number 影响的行数
	 */
	public function chgLoginPasswd($password) {
		if (!self::isLogin()) {
			throw new Exception('没有登录用户');
		} else {
			$currentLoginId = self::loginInfo('id');
			$salt = \Yii::$app->getSecurity()->generateRandomString(8);
			return parent::update($currentLoginId, ['salt' => $salt, 'password' => StringUtil::genPassword($password, $salt)]);
		}
	}
	
	/**
	 * 直接从数据库获取当前登录的用户信息
	 * @throws Exception
	 * @return array
	 */
	public function getCurrentLogin() {
		if (!self::isLogin()) {
			throw new Exception('没有登录用户');
		}
		$currentLoginId = self::loginInfo('id');
		$collegeAdmin = parent::get($currentLoginId);
		return $collegeAdmin;
	}
}