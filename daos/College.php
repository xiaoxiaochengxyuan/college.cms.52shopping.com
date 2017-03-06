<?php
namespace app\daos;
use app\base\BaseDao;
use yii\base\Exception;
/**
 * 大学对应的Dao
 * @author xiawei
 */
class College extends BaseDao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'college';
	
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
	 * @return College
	 */
	public static function instance($className = __CLASS__) {
		return parent::instance($className);
	}
	
	/**
	 * 通过当前登录管理员获取其所在大学的数据
	 * @param string $field 对应的数据字段
	 * @throws Exception 如果没有登录抛出异常
	 * @return string|\app\base\NULL|\yii\db\false
	 */
	public function getCurrentLoginCollege($field = null) {
		if (!CollegeAdmin::isLogin()) {
			throw new Exception();
		}
		$currentCollegeId = CollegeAdmin::loginInfo('college_id');
		if (empty($field)) {
			return parent::getByColumn('id', $currentCollegeId);
		}
		return parent::scalarByPrimaryKey($currentCollegeId, $field);
	}
}