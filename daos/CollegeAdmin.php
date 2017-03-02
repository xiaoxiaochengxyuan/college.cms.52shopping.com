<?php
namespace app\daos;
use app\base\BaseDao;
use yii\helpers\Json;
use app\utils\StringUtil;
use yii\web\Cookie;
/**
 * 大学管理员Dao
 * @author xiawei
 */
class CollegeAdmin extends BaseDao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'college_admin';
	
	const COLLEGE_ADMIN_COOKIE_KEY = 'college_admin_cookie_key';
	
	/**
	 * {@inheritDoc}
	 * @see \app\base\BaseDao::tableName()
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
			if (\Yii::$app->request->getCookies()->has(self::COLLEGE_ADMIN_COOKIE_KEY)) {
				$collegeAdminCookie = \Yii::$app->request->getCookies()->getValue(self::COLLEGE_ADMIN_COOKIE_KEY);
				$collegeAdminJson = StringUtil::decryStr($collegeAdminCookie);
				$collegeAdmin = Json::decode($collegeAdminJson);
				return isset($collegeAdmin['id']) && isset($collegeAdmin['username']) && isset($collegeAdmin['college_id']);
			}
		} catch (\Exception $e) {
			return false;
		}
		return false;
	}
	
	/**
	 * 用户登录
	 * @param array $collegeAdmin
	 */
	public static function login(array $collegeAdmin) {
		//首先去掉密码和加密盐
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
	 * 获取登录用户的一些信息
	 * @param string $field 要获取的信息字段
	 * @return mixed|NULL|NULL
	 */
	public static function loginInfo($field = null) {
		if (self::isLogin()) {
			$collegeAdminCookie = \Yii::$app->request->getCookies()->getValue(self::COLLEGE_ADMIN_COOKIE_KEY);
			$collegeAdminJson = StringUtil::decryStr($collegeAdminCookie);
			$collegeAdmin = Json::decode($collegeAdminJson);
			if (empty($field)) {
				return $collegeAdmin;
			}
			return isset($collegeAdmin[$field]) ? $collegeAdmin[$field] : null;
		}
		return null;
	}
}