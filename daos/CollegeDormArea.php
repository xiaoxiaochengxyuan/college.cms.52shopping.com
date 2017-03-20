<?php
namespace app\daos;
use app\base\Dao;
/**
 * 大学区域对应的Dao
 * @author xiawei
 */
class CollegeDormArea extends Dao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'college_dorm_area';
	
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
	 * @return CollegeDormArea
	 */
	public static function instance($className = __CLASS__) {
		return parent::instance($className);
	}
	
	/**
	 * 获取当前登录用户所在大学区域信息
	 * @param string $fieldName 要获取的信息
	 * @throws Exception 没登录异常
	 * @return string|\app\base\NULL|\yii\db\false
	 */
	public function getCurrentLoginCollegeDormArea($fieldName = null) {
		if (!CollegeAdmin::isLogin()) {
			throw new Exception('对不起,请先登录');
		}
		//获取对应的大学区域Id
		$collegeDormAreaId = CollegeAdmin::loginInfo('college_dorm_area_id');
		return empty($fieldName) ? $this->get($collegeDormAreaId) : $this->scalarByPrimaryKey($collegeDormAreaId, $fieldName);
	}
}