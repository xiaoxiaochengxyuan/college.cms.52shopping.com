<?php
namespace app\daos;
use app\base\BaseDao;
/**
 * 商品对应Dao
 * @author xiawei
 */
class Product extends BaseDao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'product';
	
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
	 * @return Product
	 */
	public static function instance($className = __CLASS__) {
		parent::instance($className);
	}
}