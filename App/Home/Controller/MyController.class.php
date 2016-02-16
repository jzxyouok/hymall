<?php 
/*
 *前台基础控制器
 */
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller{
	public function _initialize(){
		//获取购物车中的总商品数和总价格
		$cart_model=new \Model\CartModel();
		$total=$cart_model->getTotal();
		$this->assign('total',$total);

		//取出顶级栏目，用于导航显示
    	$cat_model=new \Model\CategoryModel();
    	$nav_list=$cat_model->getNav();
    	$this->assign('nav_list',$nav_list);
	}
}