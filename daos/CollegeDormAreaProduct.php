<?php
namespace app\daos;
use app\base\Dao;
use yii\data\Pagination;
/**
 * 大学商品对应的Dao
 * @author xiawei
 */
class CollegeDormAreaProduct extends Dao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'college_dorm_area_product';
	
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
	 * @return CollegeDormAreaProduct
	 */
	public static function instance($className = __CLASS__) {
		return parent::instance($className);
	}
	
	/**
	 * 通过查询条件获取满足条件的商品总数
	 * @param array $search 查询条件
	 * @return number
	 */
	public function countBySearch($search) {
		return $this->count();
	}
	
	
	/**
	 * 分页查询大学区域商品
	 * @param array $search 查询条件
	 * @param Pagination $pagination 分页组件
	 * @return array
	 */
	public function pageBySearch($search, Pagination $pagination) {
		$condition = ['and'];
		$select = [
			'cdap.id',
			'p.name as product_name',
			'p.title_img as product_title_img',
			'cdap.show_buy_number',
			'cdap.buy_number',
			'cdap.num',
			'p.stock_price',
			'p.price',
			'tpc.name as top_cat_name',
			'pc.name as cat_name',
			'p.grounding as system_grounding',
			'cdap.grounding',
			'cdap.is_jinpin'
		];
		return $this->createQuery()
			->select($select)
			->from($this->tableName().' cdap')
			->leftJoin(Product::TABLE_NAME.' p', 'p.id=cdap.product_id')
			->leftJoin(ProductCat::TABLE_NAME.' tpc', 'tpc.id=p.top_cat_id')
			->leftJoin(ProductCat::TABLE_NAME.' pc', 'pc.id=p.cat_id')
			->where($condition)
			->offset($pagination->getOffset())
			->limit($pagination->getLimit())
			->all(self::db());
	}
	
	
	/**
	 * 判断某个商品的库存类型是否发生变化
	 * @param int $id 对应的大学区域商品Id
	 * @return boolean
	 */
	public function optionNumChanged($id) {
		$collegeDormAreaProduct = CollegeDormAreaProduct::instance()->get($id, ['is_options_num', 'product_id']);
		//获取大学区域商品库存类型
		$collegeDormAreaProductIsOptionNum = $collegeDormAreaProduct['is_options_num'];
		//获取商品库存类型
		$productIsOptionNum = Product::instance()->scalarByPrimaryKey($collegeDormAreaProduct['product_id'], 'is_options_num');
		return $collegeDormAreaProductIsOptionNum != $productIsOptionNum;
	}
}