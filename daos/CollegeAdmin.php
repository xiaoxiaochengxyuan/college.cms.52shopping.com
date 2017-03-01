<?php
namespace app\daos;
use app\base\BaseDao;
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
	
	const CMS_ADMIN_COOKIE_KEY = 'college_admin_cookie_key';
	
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
		return false;
	}
}