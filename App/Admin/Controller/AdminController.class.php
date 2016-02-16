<?php 
/*
管理员控制器
 */
namespace Admin\Controller;
use Think\Controller;
class AdminController extends MyController{
	//添加管理员（直接分配角色）
	public function add(){
		if(IS_POST){
			$model=new \Model\AdminModel();
			if($data=$model->create()){
				//生成salt
				$str=uniqid();
				$salt=substr($str, -6);
				$password=I('post.password');
				//生成密码
				$data['password']=md5(md5($password).$salt);
				$data['salt']=$salt;
				if($model->add($data)){
					$this->success('添加管理员成功',U('showlist'),1);
					exit;
				}
				$this->error('添加管理员失败');
			}
			$this->error($model->getError());
		}
		//获取角色并遍历显示
		$role_list=M('Role')->select();
		$this->assign('role_list',$role_list);
		$this->display();
	}

	//管理员列表（超级管理员不显示）
	public function showlist(){
		$admin_list=M('Admin')->field("it_admin.admin_id,it_admin.admin_name,it_role.role_name")
		->join("left join it_admin_role using(admin_id) left join it_role using(role_id)")
		->select();
		$this->assign('admin_list',$admin_list);
		$this->display();
	}

	//删除管理员（管理员和角色之间的关系表数据也删除）
	public function del($admin_id){
		$admin_id=$admin_id+0;
		$model=new \Model\AdminModel();
		//超级管理员不允许删除
		if($admin_id==1){
			$this->error('参数错误');
		}
		if($model->delete($admin_id)!==false){
			$this->success('删除管理员成功',U('showlist'),1);
			exit;
		}
		$this->error('删除角色失败');
	}

	//修改管理员（管理员和角色之间的关系表数据也修改，，先删除再添加）
	public function update($admin_id){
		$admin_id=$admin_id+0;
		$model=new \Model\AdminModel();
		if(IS_POST){
			if($data=$model->create()){
				$password=I('post.password');
				//判断有没有输入新密码
				if(empty($password)){
					unset($data['password']);
				}else{
					//重新生成密码和salt
					$str=uniqid();
					$salt=substr($str, -6);
					$password=I('post.password');
					//生成密码
					$data['password']=md5(md5($password).$salt);
					$data['salt']=$salt;	
				}
				if($model->save($data)!==false){
					$this->success('修改管理员成功',U('showlist'),1);
					exit;
				}
				$this->error('修改管理员失败');
			}
			$this->error($model->getError());
		}
		//获取要修改管理员的属性并显示
		$info=$model->field('admin_id,admin_name,role_id')
		->join("left join it_admin_role using(admin_id)")->find($admin_id);
		$this->assign('info',$info);
		//获取角色并遍历显示
		$role_list=M('Role')->select();
		$this->assign('role_list',$role_list);
		$this->display();
	}
}