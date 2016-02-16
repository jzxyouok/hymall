<?php 
	/*
	* 权限控制器
	*/
namespace Admin\Controller;
use Think\Controller;
class PrivilegeController extends MyController{
	//添加权限
	public function add(){
		$model=new \Model\PrivilegeModel();
		if(IS_POST){
			if($data=$model->create(I('post.'),1)){
				if($model->add($data)){
					$this->success('添加权限成功',U('showlist'),1);
					exit;
				}else{
					$this->error('添加权限失败');
				}
			}else{
				$this->error($model->getError());
			}
		}
		//获取格式化过的权限列表
		$priv_list=$model->getTree();
		$this->assign('priv_list',$priv_list);
		$this->display();
	}

	//权限列表
	public function showlist(){
		$model=new \Model\PrivilegeModel();
		//获取格式化过的权限列表
		$priv_list=$model->getTree();
		$this->assign('priv_list',$priv_list);
		$this->display();
	}

	// 删除权限
	public function del($priv_id){
		$priv_id=$priv_id+0;
		$model=M('Privilege');
		//判断要删除的权限有没有子权限
		$info=$model->where("parent_id=$priv_id")->select();
		if($info){
			$this->success('要删除的权限有子权限不予删除',U('showlist'),2);
			exit;	
		}
		if($model->delete($priv_id)!==false){
			$this->success('删除成功',U('showlist'),1);
			exit;
		}
		$this->error('删除失败');
	}

	//修改权限
	public function update($priv_id){
		$priv_id=$priv_id+0;
		$model=new \Model\PrivilegeModel();
		if(IS_POST){
			if($data=$model->create(I('post.'),2)){
				//判断提交的上级权限id是否属于自身和其子权限，防止恶意修改订单
				$parent_id=(int)I('post.parent_id');
				$ids=$model->getChild($priv_id);
				$ids[]=$priv_id;
				if(in_array($parent_id,$ids)){
					$this->error('不能将自身或者自身子权限当做上级权限');
				}
				if($model->save($data)!==false){
					$this->success('修改权限成功',U('showlist'),1);
					exit;
				}
				$this->error('修改权限失败');
			}
				
			$this->error($model->getError());
		}
		//取出要修改数据的信息
		$info=$model->find($priv_id);
		$this->assign('info',$info);
		//获取格式化过的权限列表
		$priv_list=$model->getTree();
		$this->assign('priv_list',$priv_list);
		//获取自身和子权限的id，在修改页面不显示出来，防止恶意修改
		$ids=$model->getChild($priv_id);
		$ids[]=$priv_id;
		$this->assign('ids',$ids);
		$this->display();	
	}	
}