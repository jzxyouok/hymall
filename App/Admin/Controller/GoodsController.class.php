<?php 
	/*
	* 商品控制器
	*/
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends MyController{
	//添加商品
	public function add(){
		if(IS_POST){
			$model=new \Model\GoodsModel();
			if($data=$model->create()){
				if($model->add($data)){
					$this->success('添加成功',U('showlist'),1);
					exit;
				}
				else{
					$error=$model->getError();		//获取模型里面的error属性的值
					if(empty($error)){
						$error='添加失败';
					}
					$this->error($error);
				}
			}else{
				$this->error($model->getError());
			}
		}
		//取出商品栏目
		$cat_model=new \Model\CategoryModel();
		$cat_list=$cat_model->getTree();
		$this->assign('cat_list',$cat_list);
		//取出商品类别
		$type_list=M('type')->select();
		$this->assign('type_list',$type_list);
		$this->display();
	}
	/*
	*ajax动态生成属性添加表单
	*/
	public function showAttr(){
		$type_id=(int)$_GET['type_id'];
		$attr_list=M('attribute')->where("type_id=$type_id")->select();
		$this->assign('attr_list',$attr_list);
		$this->display();
	}

	//显示商品列表

	public function showlist(){
		//取出商品栏目
		$cat_model=new \Model\CategoryModel();
		$cat_list=$cat_model->getTree();
		$this->assign('cat_list',$cat_list);
		//取出商品并分页显示
		$goods_model=new \Model\GoodsModel();
		$pagesize=C('pagesize');
		$count=$goods_model->count();
		$page=new \Think\Page($count,$pagesize);
		//设置分页样式
		$page->lastSuffix=false;    //不显示末页
        $page->rollPage   = 3;      //一次显示三页
        $page->setConfig('prev', '【上一页】');
        $page->setConfig('next', '【下一页】');
        $page->setConfig('first', '【首页】');
        $page->setConfig('last', '【末页】');
        $page->setConfig('theme', '共 %TOTAL_ROW% 条记录,当前 %NOW_PAGE%/%TOTAL_PAGE%%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$pageinfo=$page->show();
		//获取当前页方便跳转
		$nowpage=$page->nowPage;
		$goods_list=$goods_model->order('goods_id desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('goods_list',$goods_list);
		$this->assign('pageinfo',$pageinfo);
		$this->assign('nowpage',$nowpage);
		$this->display();
	}

	//删除商品
	public function del($goods_id){
		$goods_id=$goods_id+0;
		$p=$_GET['p']+0;
		$goods_model=new \Model\GoodsModel();
		if($goods_model->delete($goods_id)!==false){
			$this->redirect('showlist',array('p'=>$p),1,'删除成功...');
		}else{
			$this->redirect('showlist',array('p'=>$p),2,'删除失败...');
		}
	}

	//商品库存
	public function product(){
		$goods_id=$_GET['goods_id']+0;
		$p=$_GET['p']+0;
		//库存入库
		if(IS_POST){
			$goods_id=I('post.goods_id');
			$goods_number=I('post.goods_number');
			$attr=I('post.attr');
			//修改库存，就是删除旧的数据，增加新的数据
			//取出已经存在的库存数据，如果有就删除
			$kcdata=M('Product')->where("goods_id=$goods_id")->select();
			if($kcdata){
				M('Product')->where("goods_id=$goods_id")->delete();
			}
			//计算出总的库存
			$kc=0;
			foreach ($goods_number as $k=>$v) {
				$a=array();
				foreach ($attr as $k1 => $v1) {
					$a[]=$v1[$k];
				}
				M('Product')->add(array(
					'goods_id'=>$goods_id,
					'goods_number'=>$v,
					'goods_attr_id'=>implode(',', $a)
				));
				//计算总的库存
				$kc+=$v;
			}
			//修改总的库存
			M('Goods')->where("goods_id=$goods_id")->setField('goods_number',$kc);
			$this->success('添加库存成功',U('showlist',array('p'=>$p)),1);
			exit;
		}

		//修改库存，先把设置的库存取出来显示
		$kcdata=M('Product')->where("goods_id=$goods_id")->select();
		$this->assign('kcdata',$kcdata);

		$goods_model=new \Model\GoodsModel();
		$goods_info=$goods_model->field("goods_name")->find($goods_id);
		$this->assign('goods_info',$goods_info);
		//取出设置库存的属性id和属性名及值
		$data=$goods_model->getRadio($goods_id);
		//为了方便遍历，转换成三维数组
		$radiodata=array();
		foreach ($data as $v) {
			$radiodata[$v['attr_id']][]=$v;
		}
		$this->assign('goods_id',$goods_id);
		$this->assign('radiodata',$radiodata);
		$this->display();
	}
}