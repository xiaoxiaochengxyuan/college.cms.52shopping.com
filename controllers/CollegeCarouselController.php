<?php
namespace app\controllers;
use app\base\BaseWebController;
use app\forms\CollegeCarouselForm;
use app\daos\College;
use app\daos\CollegeCarousel;
use app\utils\OssUtil;
/**
 * 轮播对应的Controller
 * @author xiawei
 */
class CollegeCarouselController extends BaseWebController {
	/**
	 * 轮播列表页
	 */
	public function actionIndex() {
		$collegeCarousels = CollegeCarousel::instance()->listAll('*', ['sort' => SORT_ASC]);
		$this->view->title = '轮播图片列表';
		return $this->render('index', ['collegeCarousels' => $collegeCarousels]);
	}
	
	
	/**
	 * 添加轮播图
	 */
	public function actionAdd() {
		$collegeCarouselForm = new CollegeCarouselForm();
		$collegeCarouselForm->setScenario('add');
		if (\Yii::$app->getRequest()->getIsPost()) {
			$post = \Yii::$app->getRequest()->post('CollegeCarouselForm');
			$collegeCarouselForm->setAttributes($post, false);
			if ($collegeCarouselForm->validate() && CollegeCarousel::instance()->insert($post)) {
				$this->redirect('/college-carousel');
			}
		}
		$this->view->title = '添加轮播图片';
		return $this->render('add', ['collegeCarouselForm' => $collegeCarouselForm]);
	}
	
	
	/**
	 * 修改轮播图
	 */
	public function actionUpdate() {
		$collegeCarouselForm = new CollegeCarouselForm();
		$collegeCarouselForm->setScenario('update');
		if (\Yii::$app->getRequest()->getIsPost()) {
			$post = \Yii::$app->getRequest()->post('CollegeCarouselForm');
			$collegeCarouselForm->setAttributes($post, false);
			if ($collegeCarouselForm->validate() && CollegeCarousel::instance()->update($post['id'], $post)) {
				$this->redirect('/college-carousel');
			}
		} else {
			$id = \Yii::$app->getRequest()->get('id');
			$collegeCarousel = CollegeCarousel::instance()->get($id);
			$collegeCarouselForm->setAttributes($collegeCarousel, false);
		}
		$this->view->title = '修改轮播图片';
		return $this->render('update', ['collegeCarouselForm' => $collegeCarouselForm]);
	}
	
	
	/**
	 * 修改是否可用
	 */
	public function actionChangeEnabled() {
		$id = \Yii::$app->getRequest()->get('id');
		//获取当前轮播是否可用
		$enabled = CollegeCarousel::instance()->scalarByPrimaryKey($id, 'enabled');
		$updateEnabled = $enabled == 1 ? 0 : 1;
		if (CollegeCarousel::instance()->update($id, ['enabled' => $updateEnabled])) {
			return $this->ajaxSuccReturn();
		}
		return $this->ajaxErrReturn(ERROR_CODE_OPTION_FAILED, '操作失败');
	}
	
	
	/**
	 * 上移一个轮播图
	 */
	public function actionUp() {
		$id = \Yii::$app->getRequest()->get('id');
		//获取对应的大学轮播
		$collegeCarousel = CollegeCarousel::instance()->get($id, ['sort', 'college_id', 'id']);
		$transaction = CollegeCarousel::db()->beginTransaction();
		if ($collegeCarousel['sort'] > 1) {
			//获取上一个轮播图
			$prevCollegeCarousel = CollegeCarousel::instance()->getBySortAndCollegeId($collegeCarousel['college_id'], $collegeCarousel['sort'] - 1, ['sort', 'college_id', 'id']);
			//交换两个轮播图的顺序
			if (
				!(CollegeCarousel::instance()->update($collegeCarousel['id'], ['sort' => $collegeCarousel['sort'] - 1]) &&
				CollegeCarousel::instance()->update($prevCollegeCarousel['id'], ['sort' => $prevCollegeCarousel['sort'] + 1]))
			) {
				$transaction->rollBack();
				return $this->ajaxErrReturn(ERROR_CODE_OPTION_FAILED, '上移轮播图失败');
			}
		}
		$transaction->commit();
		return $this->ajaxSuccReturn();
	}
	
	
	/**
	 * 下移一个轮播图
	 */
	public function actionDown() {
		$id = \Yii::$app->getRequest()->get('id');
		//获取对应的大学轮播
		$collegeCarousel = CollegeCarousel::instance()->get($id, ['sort', 'college_id', 'id']);
		//获取对应大学轮播的总数
		$count = CollegeCarousel::instance()->countByColumn('college_id', $collegeCarousel['college_id']);
		$transaction = CollegeCarousel::db()->beginTransaction();
		if ($collegeCarousel['sort'] < $count) {
			//获取下一个轮播图
			$nextCollegeCarousel = CollegeCarousel::instance()->getBySortAndCollegeId($collegeCarousel['college_id'], $collegeCarousel['sort'] + 1, ['sort', 'college_id', 'id']);
			if (
				!(CollegeCarousel::instance()->update($collegeCarousel['id'], ['sort' => $collegeCarousel['sort'] + 1]) &&
				CollegeCarousel::instance()->update($nextCollegeCarousel['id'], ['sort' => $nextCollegeCarousel['sort'] - 1]))
			) {
				$transaction->rollBack();
				return $this->ajaxErrReturn(ERROR_CODE_OPTION_FAILED, '下移轮播图失败');
			}
		}
		$transaction->commit();
		return $this->ajaxSuccReturn();
	}
	
	/**
	 * 删除一个轮播图
	 */
	public function actionDelete() {
		$id = \Yii::$app->getRequest()->get('id');
		//首先获取对应的轮播图
		$collegeCarousel = CollegeCarousel::instance()->get($id);
		OssUtil::deleteFile($collegeCarousel['image_url']);
		
	}
}