<?php
namespace app\daos;
use app\base\Dao;
/**
 * 商品对应Dao
 * @author xiawei
 */
class Product extends Dao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'product';
	
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
	 * @return Product
	 */
	public static function instance($className = __CLASS__) {
		return parent::instance($className);
	}
}