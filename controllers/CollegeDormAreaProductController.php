<?php
namespace app\controllers;
use app\base\BaseWebController;
use yii\data\Pagination;
use app\daos\CollegeDormAreaProduct;
use app\daos\Product;
/**
 * 大学区域商品对应的Controller
 * @author xiawei
 */
class CollegeDormAreaProductController extends BaseWebController {
	/**
	 * 区域商品列表Action
	 * @return string
	 */
	public function actionIndex() {
		//查询分页显示大学区域商品
		$defaultSearch = [];
		$search = \Yii::$app->getRequest()->get('search', $defaultSearch);
		$pagination = new Pagination();
		$pagination->totalCount = CollegeDormAreaProduct::instance()->countBySearch($search);
		$pagination->pageSize = 12;
		//获取对应的大学区域商品
		$collegeDormAreaProducts = CollegeDormAreaProduct::instance()->pageBySearch($search, $pagination);
		$this->view->title = '区域商品列表';
		return $this->render('index', [
			'pagination' => $pagination,
			'collegeDormAreaProducts' => $collegeDormAreaProducts
		]);
	}
	
	
	/**
	 * 改变是否上架
	 * @return \app\base\string[]
	 */
	public function actionChangeGroup() {
		$collegeDormAreaProductId = \Yii::$app->getRequest()->get('collegeDormAreaProductId');
		$grounding = CollegeDormAreaProduct::instance()->scalarByPrimaryKey($collegeDormAreaProductId, 'grounding');
		if (CollegeDormAreaProduct::instance()->update($collegeDormAreaProductId, ['grounding' => $grounding == 0 ? 1 : 0])) {
			return $this->ajaxSuccReturn($grounding == 1 ? '下架成功' : '上架成功');
		}
		return $this->ajaxErrReturn(ERROR_CODE_OPTION_FAILED, $grounding == 1 ? '下架失败' : '上架失败');
	}
	
	
	public function actionGetBasicInfo() {
		$collegeDormAreaProductId = \Yii::$app->getRequest()->get('collegeDormAreaProductId');
		//首先获取商品的基本信息
		
	}
	
	/**
	 * 判断一个商品的库存类型是否变化
	 */
	public function actionIsOptionNumChged() {
		$id = \Yii::$app->getRequest()->get('id');
		return $this->ajaxReturn(CollegeDormAreaProduct::instance()->optionNumChanged($id));
	}
	
	/**
	 * 修改是否是精品
	 */
	public function actionChgJinpin() {
		$id = \Yii::$app->getRequest()->get('id');
		$isJinpin = CollegeDormAreaProduct::instance()->scalarByPrimaryKey($id, 'is_jinpin');
		if (CollegeDormAreaProduct::instance()->update($id, ['is_jinpin' => $isJinpin == 0 ? 1 : 0])) {
			return $this->ajaxSuccReturn('设置精品成功');
		}
		return $this->ajaxErrReturn(ERROR_CODE_OPTION_FAILED, '设置精品失败');
	}
}