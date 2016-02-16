<?php 
/*
 *前台订单控制器
 */
namespace Home\Controller;
use Think\Controller;
class OrderController extends MyController{
	//下订单
	public function checkout(){
		//1,判断购物车中有没有商品,有才给下单
		$cart_model=new \Model\CartModel();
		$total=$cart_model->getTotal();
		if($total['total_count']==0){
			$this->success('购物车中没有商品，无法下单',U('Index/index'),1);
			exit;	
		}
		//2,判断用户有没有登陆，登陆后才给下单
		$user_id=$_SESSION['user_id'];
		if(!$user_id){
			//没有登陆跳转登陆页面，登陆完再跳回来
			$_SESSION['return_url']='Order/checkout';
			$this->redirect('User/login');
		}
		//3,判断有没有填写收货人信息,根据user_id查找it_address中的信息
		$consignee_info=M('Address')->where("user_id=$user_id")->find();
		if(!$consignee_info){
			//没有记录则跳转到添加收货人页面
			$this->redirect('Order/writeAddress');
		}
		//获取收货人信息并显示
		$this->assign('consignee_info',$consignee_info);
		//获取购物车中商品的信息并显示
		$cartlist=$cart_model->cartlist();
		$this->assign('cartlist',$cartlist);
		$this->display();
	}

	//添加收货人信息
	public function writeAddress(){
		if(IS_POST){
			$data['user_id']=$_SESSION['user_id'];
			$data['consignee']=I('post.consignee');
			$data['address']=I('post.address');
			$data['post']=I('post.post');
			$data['mobile']=I('post.mobile');
			$rs=M('Address')->add($data);
			if($rs){
				$this->success('添加收货人信息成功',U('Order/checkout'),1);
				exit;
			}
			$this->error('添加收货人信息失败');

		}
		$this->display();
	}

	//订单入库，和订单商品关系表数据添加
	public function flow(){
		//获取购物车中的全部商品
		$cart_model=new \Model\CartModel();
		$cartlist=$cart_model->cartlist();


		//下单之前要判断库存是否充足
		//运用文件锁和事务，防止订单出错
		 $fp = fopen('./Public/order.lock','w');
		 //开始加锁
		if ( flock ( $fp ,  LOCK_EX )) {
			 foreach ($cartlist as $v) {
				//取出库存，根据goods_id,goods_attr_id来取出（没有属性的商品则在goods表中取）
				if(!empty($v['goods_attr_id'])){
					$where = "goods_id=".$v['goods_id']." and goods_attr_id='".$v['goods_attr_id']."'";
					$kc=M('Product')->where($where)->find();	//返回一个一维数组
				}else{
					$kc=M('Goods')->where("goods_id=".$v['goods_id'])->find();
				}
				if($kc['goods_number']<$v['goods_count']){
					$this->error('库存不足，无法下订单');
				}
			}
			//在checkout.html中表单增加隐藏域，用来获取收货人的信息，也可以用连表
			//查询的形式，在订单信息表中就不用收货人信息的几个字段，改成收货人表的
			//id字段做关联
			$data['user_id']=$_SESSION['user_id'];		//用户登陆的id
			$data['order_sn']='sn_'.uniqid();			//订单号
			$cart_model=new \Model\CartModel();
			$total=$cart_model->getTotal();
			$data['goods_amount']=$total['total_price'];//总金额	
			$data['consignee']=I('post.consignee');		//收货人名
			$data['address']=I('post.address');		//收货人地址
			$data['mobile']=I('post.mobile');		//收货人手机
			$data['payment']=I('post.payment');		//支付方式
			$data['shipping']=I('post.shipping');   //配送方式
			$data['addtime']=time();				//下单时间
			//开启事务
			mysql_query("start transaction");
			$order_id=M('OrderInfo')->add($data);	//添加订单信息，成功返回自增的订单编号
			if(!$order_id){
				//失败就回滚，并释放文件锁
				mysql_query("rollback");
				flock ( $fp ,  LOCK_UN );     // 释放锁定
			}

			//将购物车中的商品全部遍历添加到订单商品关系表中
			foreach ($cartlist as $v) {
				$res_id=M('OrderGoods')->add(array(
					'order_id'=>$order_id,
					'goods_id'=>$v['goods_id'],
					'goods_name'=>$v['info']['goods_name'],
					'goods_attr_id'=>$v['goods_attr_id'],
					'shop_price'=>$v['info']['shop_price'],
					'goods_count'=>$v['goods_count']
				));
				if(!$res_id){
					//失败就回滚，并释放文件锁
					mysql_query("rollback");
					flock ( $fp ,  LOCK_UN );     // 释放锁定
				}
			}

			//下单成功，有一个减少库存的操作
			//判断订单商品有没有goods_attr_id，有则在product表中修改，没有则在goods表中修改
			foreach ($cartlist as $v) {
				//取出库存，根据goods_id,goods_attr_id来取出（没有属性的商品则在goods表中取）
				if(!empty($v['goods_attr_id'])){
					$where = "goods_id=".$v['goods_id']." and goods_attr_id='".$v['goods_attr_id']."'";
					$rs=M('Product')->where($where)->setDec('goods_number',$v['goods_count']);
					//还要更改商品表中的库存量
					M('Goods')->where("goods_id=".$v['goods_id'])->setDec('goods_number',$v['goods_count']);
					if(!$rs){
						//失败就回滚，并释放文件锁
						mysql_query("rollback");
						flock ( $fp ,  LOCK_UN );     // 释放锁定
					}	
				}else{
					$rs=M('Goods')->where("goods_id=".$v['goods_id'])->setDec('goods_number',$v['goods_count']);
					if(!$rs){
						//失败就回滚，并释放文件锁
						mysql_query("rollback");
						flock ( $fp ,  LOCK_UN );     // 释放锁定
					}
				}
			}
			//都成功，提交事务
			mysql_query("commit");
			flock ( $fp ,  LOCK_UN );     // 释放锁定
		}else{
			$this->error('系统忙，请稍后下单');
		}
		
		//订单成功，要清空购物车，跳转到显示订单完成的页面
		$cart_model->clearCart();
		$this->redirect("Order/done",array('order_sn'=>$data['order_sn']));
	}

	//显示订单完成的页面
	public function done(){
		$order_sn=$_GET['order_sn'];
		$this->assign('order_sn',$order_sn);
		$this->display();
	}
}