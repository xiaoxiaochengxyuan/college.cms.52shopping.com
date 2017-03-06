<?php
namespace app\daos;
use app\base\BaseDao;
/**
 * 大学对应的轮播
 * @author xiawei
 */
class CollegeCarousel extends BaseDao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'college_carousel';
	
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
	 * @return CollegeCarousel
	 */
	public static function instance($className = __CLASS__) {
		return parent::instance($className);
	}
	
	/**
	 * {@inheritDoc}
	 * @see \app\base\BaseDao::insert()
	 */
	public function insert($data) {
		//获取当前登录学校的Id
		$collegeId = CollegeAdmin::loginInfo('college_id');
		$data['college_id'] = $collegeId;
		//获取到当前学校的轮播的总数
		$sort = $this->countByColumn('college_id', $collegeId) + 1;
		$data['sort'] = $sort;
		return parent::insert($data);
	}
	
	/**
	 * 通过大学Id和排序获取对应的大学轮播图
	 * @param integer $collegeId 对应的大学Id
	 * @param integer $sort 对应的排序 
	 * @param string $select 要查询的数据
	 * @return string|NULL|\yii\db\false
	 */
	public function getBySortAndCollegeId($collegeId, $sort, $select = '*') {
		return $this->createQuery()
			->select($select)
			->from($this->tableName())
			->where('college_id=:college_id and sort=:sort', [':college_id' => $collegeId, ':sort' => $sort])
			->one(self::db());
	}
	
	/**
	 * 通过大学Id和排序获取对应的大学轮播图属性
	 * @param integer $collegeId 对应的大学Id
	 * @param integer $sort 对应的排序
	 * @param string $select 要查询的数据
	 * @return string
	 */
	public function scalarBySortAndCollegeId($collegeId, $sort, $select) {
		return $this->createQuery()
			->select($select)
			->from($this->tableName())
			->where('college_id=:college_id and sort=:sort', [':college_id' => $collegeId, ':sort' => $sort])
			->scalar(self::db());
	}
}