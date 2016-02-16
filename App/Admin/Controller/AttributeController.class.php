<?php
	/*
	* 商品属性控制器
	*/
namespace Admin\Controller;
use Think\Controller;
class AttributeController extends MyController{
	//添加商品属性
	public function add(){
		if(IS_POST){
			$model=new \Model\AttributeModel();
			if($data=$model->create(I('post.'),1)){
				if($model->add($data)){
					$type_id=I('post.type_id');
					$this->success('添加商品属性成功',U('showlist',array('type_id'=>$type_id)),1);
					exit;
				}
				else{
					$this->error('添加属性失败');
				}
			}else{
				$this->error($model->getError());
			}
		}
		//获取商品类别
		$attr_model=M('type');
		$list=$attr_model->select();
		$this->assign('list',$list);
		$this->display();
	}
	//显示商品属性列表
	public function showlist(){
		$type_id=(int)$_GET['type_id'];
		if($type_id==0){
			$where=1;
		}else{
			$where="type_id=$type_id";
		}
		//取出商品类型
		$typelist=M('type')->select();
		$this->assign('typelist',$typelist);
		//分页取出商品属性
		$model=M('attribute');
		$count=$model->where($where)->count();
		$pagesize=C('pagesize');
		$page=new \Think\Page($count,$pagesize);
		//获取当前页方便跳转
		$nowpage=$page->nowPage;
		//设置分页样式
		$page->lastSuffix=false;    //不显示末页
        $page->rollPage   = 3;      //一次显示三页
        $page->setConfig('prev', '【上一页】');
        $page->setConfig('next', '【下一页】');
        $page->setConfig('first', '【首页】');
        $page->setConfig('last', '【末页】');
        $page->setConfig('theme', '共 %TOTAL_ROW% 条记录,当前 %NOW_PAGE%/%TOTAL_PAGE%%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$pageinfo=$page->show();
		$list=$model->field('it_attribute.*,it_type.type_name')->limit($page->firstRow.','.$page->listRows)
		->join('left join it_type using(type_id)')->where($where)->select();
		$this->assign('list',$list);
		//传递类别编号，用于跳转
		$this->assign('type_id',$type_id);
		$this->assign('nowpage',$nowpage);
		$this->assign('pageinfo',$pageinfo);
		$this->display();
	}
	//删除商品属性
	public function del($attr_id){
		$attr_id=(int)$attr_id;
		$pageno=(int)$_GET['p'];
		$type_id=(int)$_GET['type_id'];
		$model=M('attribute');
		if($model->delete($attr_id)!==false){
			$this->redirect('showlist',array('p'=>$pageno,'type_id'=>$type_id),1,'删除成功...');
		}
		else{
			$this->redirect('showlist',array('p'=>$pageno,'type_id'=>$type_id),3,'删除失败...');
		}
	}
	//修改商品属性
	public function update($attr_id){
		$attr_id=(int)$attr_id;
		$pageno=(int)$_GET['p'];
		if(IS_POST){
			$model=new \Model\AttributeModel();
			$type_id=(int)$_POST['type_id'];
			if($data=$model->create(I('post.'),2)){
				if($model->save($data)!==false){
					$this->redirect('showlist',array('p'=>$pageno,'type_id'=>$type_id),1,'修改成功...');
					exit;
				}
				else{
					$this->redirect('showlist',array('p'=>$pageno,'type_id'=>$type_id),3,'修改失败...');
					exit;
				}
			}else{
				$this->error($model->getError());
			}
		}
		//取出商品类型
		$typelist=M('type')->select();
		$this->assign('typelist',$typelist);
		$info=M('attribute')->field('it_attribute.*,it_type.type_name')->join('left join it_type using(type_id)')->find($attr_id);
		$this->assign('info',$info);
		$this->display();
	}
}