<?php
namespace app\controllers;
use app\base\BaseWebController;
use app\daos\CollegeProduct;
use yii\data\Pagination;
/**
 * 大学商品对应的Controller
 * @author xiawei
 */
class CollegeProductController extends BaseWebController {
	/**
	 * 商品列表页
	 */
	public function actionIndex() {
		$defaultSearch = [];
		$search = \Yii::$app->getRequest()->get('search', $defaultSearch);
		$count = CollegeProduct::instance()->countBySearch($search);
		$pagination = new Pagination();
		$pagination->totalCount = $count;
		$pagination->pageSize = 20;
		$collegeProducts = CollegeProduct::instance()->pageBySearch($search, $pagination);
		$this->view->title = '大学商品列表页';
		return $this->render('index', ['collegeProducts' => $collegeProducts, 'pagination' => $pagination]);
	}
}