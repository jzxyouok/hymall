<?php 
/*
 *后台订单管理控制器
 */
namespace Admin\Controller;
use Think\Controller;
class OrderController extends MyController{
	//订单列表页面
	public function showlist(){
		$order_list=M('OrderInfo')->order('order_id desc')->select();
		$this->assign('order_list',$order_list);
		$this->display();
	}

	//鼠标滑动到订单号上显示商品信息
	public function showGoods(){
		$order_id=$_GET['order_id']+0;
		//根据订单的order_id取出数据
		$data=M('OrderGoods')->where("order_id=$order_id")->select();
		//重新构建数组，取出商品的缩略图和商品的属性信息
		$goodsdata=array();
		$cart_model=new \Model\CartModel();
		foreach ($data as $v) {
			//获取商品信息
			$v['info']=M('Goods')->field('goods_thumb,goods_sn')
			->find($v['goods_id']);
			//获取商品属性
			$v['attrs']=$cart_model->getAttrs($v['goods_attr_id']);
			//获取商品库存
			$where = "goods_id=".$v['goods_id']." and goods_attr_id='".$v['goods_attr_id']."'";
			$product=M('Product')->where($where)->find();
			$v['goods_number']=$product['goods_number'];
			$goodsdata[]=$v;
		}
		$this->assign('goodsdata',$goodsdata);
		$this->display();
	}
}