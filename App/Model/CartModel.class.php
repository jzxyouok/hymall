<?php 
/*
*购物车模型
 */
namespace Model;
use Think\Model;
class CartModel extends Model{
	//添加商品到购物车
	//参数1，商品的编号
	//参数2，属性的id，是string 表it_goods_attr中的id，多个用逗号隔开
	//参数3，购买商品的数量
	public function addCart($goods_id,$goods_attr_id,$goods_count){
		//判断用户是否登陆
		$user_id=$_SESSION['user_id'];
		if($user_id>0){
			//已经登陆，购物车入库
			//判断该商品是否已在购物车，如果有则更改数量，没有则添加商品
			//$goods_attr_id是字符串要加引号
			$info=$this->where("goods_id=$goods_id and goods_attr_id='$goods_attr_id' and user_id=$user_id")
			->select();
			if($info){
				//已存在则修改数量
				$this->where("goods_id=$goods_id and goods_attr_id='$goods_attr_id' and user_id=$user_id")
				->setInc("goods_count",$goods_count);
			}else{
				//没有商品则添加
				$this->add(array(
					'goods_id'=>$goods_id,
					'goods_attr_id'=>$goods_attr_id,
					'goods_count'=>$goods_count,
					'user_id'=>$user_id
				));
			}
			
		}else{
			//没有登陆，购物车入cookie，商品在cookie中以一维数组保存，键是商品id和it_goods_attr表id
			//（多个用逗号隔开）用'-'连接而成，值就是购买的数量，比如1-4,5=>10,代表1号商品
			//属性id是4和5的商品买10个。。
			//先判断cookie中有没有已经加入的商品，取出反序列化成一个数组，没有则定义一个空数组
			$cartdata=isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array();
			//判断新加入的商品购物车中是否已经存在，有的话增加数量，没有的话将商品加入购物车
			//构造键
			$key=$goods_id.'-'.$goods_attr_id;
			if(isset($cartdata[$key])){
				//商品已存在，添加数量
				$cartdata[$key]=$cartdata[$key]+$goods_count;
			}else{
				//商品不存在，将添加商品
				$cartdata[$key]=$goods_count;
			}
			//添加完成后再存入cookie中，有效期7天，名为cart
			setcookie('cart',serialize($cartdata),time()+3600*24*7,'/');
		}
	}

	//定义一个函数根据$goods_attr_id获得商品的属性
	public function getAttrs($goods_attr_id){
		if(empty($goods_attr_id)){
			//传递的值为空，证明没有属性，直接返回空字符串
			return '';
		}
		//传递了值则连表it_goods_attr,it_attribute查询出属性名和属性值，并生成'颜色:灰色 
		//<br>内存：4G这样的字符串
		$sql="select group_concat(concat(b.attr_name,':',a.attr_value) separator '<br/>') attrs
		 from it_goods_attr a left join it_attribute b using(attr_id) where a.id in ($goods_attr_id)";
		 $date=M()->query($sql);
		 return $date[0]['attrs'];
	}

	//定义一个显示购物车列表的方法
	public function cartlist(){
		//判断用户是否登录，登录从数据库中取数据，没有则在cookie中取
		$user_id=$_SESSION['user_id'];
		if($user_id>0){
			//用户已登录
			$cartdata=$this->where("user_id=$user_id")->select();	//返回一个二维数组
		}else{
			//没有登录，从cookie中获取数据
			$cart=isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array();
			//返回一维数组，为了便于显示转换成二维数组
			$cartdata=array();
			foreach($cart as $k=> $v){
				$a=explode('-', $k);
				$cartdata[]=array(
					'goods_id'=>$a[0],
					'goods_attr_id'=>$a[1],
					'goods_count'=>$v
				);
			}
		}
		//现在的$cartdata已经是一个没有商品基本信息和属性的二维数组，再把基本信息和属性加入到数组中
		$list=array();		//定义空数组保存新的数组用于返回
		foreach($cartdata as $v){
			//在$v中添加字段保存商品的基本信息和商品的属性
			$v['info']=M('Goods')->field('goods_name,goods_thumb,shop_price')->find($v['goods_id']);
			$v['attrs']=$this->getAttrs($v['goods_attr_id']);
			$list[]=$v;
		}
		return $list;
	}

	//定义一个统计购物车商品总数量和总价格的方法
	public function getTotal(){
		//获取购物车中的商品，如果有才统计，没有就不用
		$cartdata=$this->cartlist();	//返回购物车中商品列表
		$total_count=0;			//定义一个变量保存商品总数量
		$total_price=0;			//定义一个变量保存商品总价
		if(!empty($cartdata)){
			//需要计算
			foreach ($cartdata as $v) {
				$total_count+=$v['goods_count'];
				$total_price+=$v['info']['shop_price']*$v['goods_count'];
			}	
		}
		return array('total_count'=>$total_count,'total_price'=>$total_price);
	}

	//当用户登陆后，将cookie中的数据转移到数据库中（购物车里的商品）
	public function cookie2db(){
		//取出cookie中的数据(一维数组)
		$cartdata=isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array();
		//有数据才转移
		if(!empty($cartdata)){
			$user_id=$_SESSION['user_id'];
			//开始转移
			foreach($cartdata as $k=>$v){
				$a=explode('-',$k);
				$goods_id=$a[0];
				$goods_attr_id=$a[1];
				$goods_count=$v;
				//判断数据库中是否已经存在该商品，如果有则修改数量，没有则添加
				$info=$this->where("goods_id=$goods_id and 
				goods_attr_id='$goods_attr_id' and user_id=$user_id")->select();
				if($info){
					//存在该商品，修改数量
					$this->where("goods_id=$goods_id and 
				goods_attr_id='$goods_attr_id' and user_id=$user_id")->setInc("goods_count",$v);
				}else{
					//添加新数据
						$this->add(array(
							'goods_id'=>$goods_id,
							'goods_attr_id'=>$goods_attr_id,
							'goods_count'=>$goods_count,
							'user_id'=>$user_id
						)
					);
				}
			}
			//清除cookie的数据
			setcookie('cart','',time()-1,'/');
		}
	}

	//定义一个删除购物车商品的方法，用户登陆就在数据库删除，未登陆则删除cookie中对应数据
	public  function  delCart($goods_id,$goods_attr_id){
		//判断是否已经登陆
		$user_id=$_SESSION['user_id'];
		if($user_id>0){
			//已登陆，删除数据库中的数据
			$this->where("goods_id=$goods_id and goods_attr_id='$goods_attr_id' 
				and user_id=$user_id")->delete();
		}else{
			//未登陆,取出cookie中的数据
			$cartdata=isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array();
			//构造键
			$key=$goods_id.'-'.$goods_attr_id;
			unset($cartdata[$key]);
			//将剩余的数据再存入cookie中
			setcookie('cart',serialize($cartdata),time()+3600*24*7,'/');
		}
	}

	//定义一个清空购物车的方法，清空订单的情况有人为清空和下单完成
	public function clearCart(){
		//判断是否登陆
		$user_id=$_SESSION['user_id'];
		if($user_id>0){
			//已登陆,删除数据库中的数据
			$this->where("user_id=$user_id")->delete();
		}else{
			//未登陆，清空cookie
			setcookie('cart','',time()-1,'/');
		}
	}

	//定义一个修改购物车的方法
	public function  updateCart($goods_id,$goods_attr_id,$goods_count){
		//判断是否登陆
		$user_id=$_SESSION['user_id'];
		if($user_id>0){
			 //已登陆修改数据库中的数据
			 $this->where("goods_id=$goods_id and goods_attr_id='$goods_attr_id' 
				and user_id=$user_id")->setInc('goods_count',$goods_count);
		}else{
			//没有登陆更改cookie中商品的数量
			$cartdata=isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array();
			//构造键
			$key=$goods_id.'-'.$goods_attr_id;
			$cartdata[$key]=$cartdata[$key]+$goods_count;
			setcookie('cart',serialize($cartdata),time()+3600*24*7,'/');
		}
	}
}