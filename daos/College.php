<?php
namespace app\daos;
use yii\base\Exception;
use app\base\Dao;
/**
 * 大学对应的Dao
 * @author xiawei
 */
class College extends Dao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'college';
	
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
			throw new Exception('对不起,请先登录');
		}
		//获取对应的大学区域Id
		$collegeDormAreaId = CollegeAdmin::loginInfo('college_dorm_area_id');
		$select = empty($field) ? 'c.*' : "c.{$field}";
		$query = $this->createQuery()
			->select($select)
			->from($this->tableName().' c')
			->innerJoin(CollegeDormArea::TABLE_NAME.' cda', 'cda.college_id=c.id')
			->where("c.id={$collegeDormAreaId}");
		return empty($field) ? $query->one(self::db()) : $query->scalar(self::db());
	}
}