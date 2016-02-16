<?php 
/*
 *购物车控制器
 */
namespace Home\Controller;
use Think\Controller;
class CartController extends MyController{
	//添加商品进购物车
	public function addCart(){
		//接收提交的数据
		$goods_id=I('post.goods_id');
		$attr=I('post.attr');	//返回一个一维数组
		if($attr){
			//拼接goods_attr_id字符串
			$goods_attr_id=implode(',',$attr);
		}
		$goods_count=I('post.goods_count');
		$cart_model=new \Model\CartModel();
		$cart_model->addCart($goods_id,$goods_attr_id,$goods_count);
		$this->success('添加购物车成功',U('cartlist'),1);
	}

	//购物车列表
	public function cartlist(){
    	//取出购物车中商品的信息
    	$cart_model=new \Model\CartModel();
    	$list=$cart_model->cartlist();
    	$this->assign('list',$list);
		$this->display();
	}

	//购物车删除商品
	public function delCart(){
		$goods_id=$_GET['goods_id']+0;
		$goods_attr_id=I('get.goods_attr_id');
		$cart_model=new \Model\CartModel();
		$cart_model->delCart($goods_id,$goods_attr_id);
		$this->success('删除购物车商品成功',U('cartlist'),1);
	}

	//清空购物车
	public function clearCart(){
		//判断购物车中有没有商品
		$cart_model=new \Model\CartModel();
		$total=$cart_model->getTotal();
		if($total['total_count']>0){
			$cart_model->clearCart();
			$this->success('清空购物车成功',U('Index/index'),1);
			exit;
		}
		$this->error('您的购物车空了，赶紧购物吧！',U('Index/index'));
	}

	//修改购物车
	public function updateCart(){
		$goods_id=$_GET['goods_id']+0;
		$goods_attr_id=$_GET['goods_attr_id'];
		$goods_count=$_GET['goods_count']+0;
		$cart_model=new \Model\CartModel();
		$cart_model->updateCart($goods_id,$goods_attr_id,$goods_count=$goods_count);
		echo 'ok';
	}
}