<?php
namespace app\daos;
use app\base\BaseDao;
/**
 * 商品分类Dao
 * @author xiawei
 */
class ProductCat extends BaseDao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'product_cat';
	
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
	 * @return ProductCat
	 */
	public static function instance($className = __CLASS__) {
		return parent::instance($className);
	}
}