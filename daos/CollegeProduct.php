<?php
namespace app\daos;
use app\base\BaseDao;
use yii\data\Pagination;
/**
 * 大学商品对应的Dao
 * @author xiawei
 */
class CollegeProduct extends BaseDao {
	/**
	 * 表名
	 * @var string
	 */
	const TABLE_NAME = 'college_product';
	
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
	 * @return CollegeProduct
	 */
	public static function instance($className = __CLASS__) {
		return parent::instance($className);
	}
	
	/**
	 * 通过查询表单查询总数
	 * @param array $search 查询条件
	 * @return number 获取到的总数
	 */
	public function countBySearch(array $search) {
		$condition = ['and', 'grounding=1'];
		return $this->count();
	}
	
	
	public function pageBySearch(array $search, Pagination $pagination) {
		$condition = ['and', 'p.grounding=1'];
		$select = [
			'c.id',
			'c.number as college_product_number',
			'c.show_buy_number as college_product_show_by_number',
			'p.name',
			'p.price',
			'p.title_img',
			'c.buy_number',
			'tpc.name as tpc_name',
			'pc.name as pc_name'
		];
		return $this->createQuery()
			->select($select)
			->from($this->tableName().' c')
			->leftJoin(Product::TABLE_NAME.' p', 'c.product_id=p.id')
			->leftJoin(ProductCat::TABLE_NAME.' tpc', 'p.top_cat_id=tpc.id')
			->leftJoin(ProductCat::TABLE_NAME.' pc', 'p.cat_id=pc.id')
			->where($condition)
			->offset($pagination->getOffset())
			->limit($pagination->getLimit())
			->all(self::db());
	}
}