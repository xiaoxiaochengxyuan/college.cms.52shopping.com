<?php
namespace app\daos;
use app\base\Dao;
/**
 * 商品分类Dao
 * @author xiawei
 */
class ProductCat extends Dao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'product_cat';
	
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
	 * @return ProductCat
	 */
	public static function instance($className = __CLASS__) {
		return parent::instance($className);
	}
}