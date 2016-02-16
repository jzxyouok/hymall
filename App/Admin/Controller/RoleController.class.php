<?php 
/*
角色控制器
 */
namespace Admin\Controller;
use Think\Controller;
class RoleController extends MyController{
	//添加角色并给角色分配权限(在模型中用钩子函数添加权限)
	public function add(){
		if(IS_POST){
			$model=new \Model\RoleModel();
			if($data=$model->create(I('post.'),1)){
				if($model->add($data)){
					$this->success('添加角色成功',U('showlist'),1);
					exit;
				}
				$this->error('添加角色失败');
			}
			$this->error($model->getError());
		}
		//获取所有的权限
		$priv_model=new \Model\PrivilegeModel();
		$priv_list=$priv_model->getTree();
		$this->assign('priv_list',$priv_list);
		$this->display();
	}

	//获取自身的父级权限的ids
	public function getParents(){
		$priv_id=$_GET['priv_id']+0;
		$priv_model=new \Model\PrivilegeModel();
		$ids=$priv_model->getParents($priv_id);
		$this->ajaxReturn($ids);
	}

	//显示角色列表
	public function showlist(){
		$role_list=M('role')->field("it_role.*,group_concat(it_privilege.priv_name) as priv_list")
		->join("left join it_role_privilege using(role_id) left join it_privilege using(priv_id)")
		->group('it_role.role_id')->select();
		$this->assign('role_list',$role_list);
		$this->display();
	}

	//删除角色（如果角色有管理员，不给删除，之前要删除角色权限关系表中对应的数据）
	public function del($role_id){
		$role_id=$role_id+0;
		$info=M('AdminRole')->where("role_id=$role_id")->select();
		if($info){
			$this->error('该角色下有管理员，不予删除');
		}
		$model=new \Model\RoleModel();
		if($model->delete($role_id)!==false){
			$this->success('删除角色成功',U('showlist'),1);
			exit;
		}
		$this->error('删除角色失败');
	}

	//修改角色
	public function update($role_id){
		$role_id=$role_id+0;
		$model=new \Model\RoleModel();
		if(IS_POST){
			if($data=$model->create(I('post.'),2)){
				if($model->save($data)!==false){
					$this->success('修改角色成功',U('showlist'),1);
					exit;
				}
				$this->error('修改角色失败');
			}
			$this->error($model->getError());
		}
		//获取所有的权限
		$priv_model=new \Model\PrivilegeModel();
		$priv_list=$priv_model->getTree();
		$this->assign('priv_list',$priv_list);
		//获取要修改角色的信息
		$role_info=$model->find($role_id);
		$this->assign('role_info',$role_info);
		$priv_info=M('RolePrivilege')->where("role_id=$role_id")->select();
		$this->assign('priv_info',$priv_info);
		$this->display();
	}
}