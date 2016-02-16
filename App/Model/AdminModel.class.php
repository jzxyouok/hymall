<?php 
	/*
	* 管理员模型
	*/
namespace Model;
use Think\Model;
class AdminModel extends Model{
	//静态验证添加管理员表单
	protected $_validate=array(
		array('admin_name','require','管理员名称不能为空'),
		array('admin_name','','管理员名称已存在',1,'unique'),
		array('password','6,12','管理员密码必须为6到12位',1,'length',1),
		array('password','6,12','管理员密码必须为6到12位',2,'length',2),
		array('rpassword','password','密码输入不一致',1,'confirm'),
	);
	//动态验证登陆表单
	public $login_rules=array(
		array('admin_name','require','管理员名称不能为空'),
		array('password','require','管理员密码不能为空'),
		array('checkcode','require','验证码不能为空'),
		array('checkcode','check_verify','验证码输入错误',1,'callback')
	);
	// 验证验证码是否正确
	protected function check_verify($code, $id = ''){ 
	  	  $verify = new \Think\Verify(); 
	      return $verify->check($code, $id);
	}
	//验证登陆的用户名和密码
	public function login(){
		//接收表单提交的数据
		$admin_name=I('post.admin_name');
		$password=I('post.password');
		//通过用户名查找数据库记录再对比密码相同
		//返回一维数组,where条件中admin_name要加引号
		$info=$this->where("admin_name='$admin_name'")->find();	
		if(md5(md5($password).$info['salt'])==$info['password']){
			//证明验证通过，记录用户信息，返回true
			$_SESSION['admin_name']=$admin_name;
			$_SESSION['admin_id']=$info['admin_id'];
			return true;
		}
		$this->error="用户名或密码错误！";//将错误信息赋予到error属性中在控制器中可直接getError获取	
		return false;
		
	}

	//添加管理员后实现管理员角色中间表数据的添加
	protected function _after_insert($data,$options){
		$admin_id=$data['admin_id'];
		$role_id=I('post.role_id')+0;
		M('AdminRole')->add(array(
			'admin_id'=>$admin_id,
			'role_id'=>$role_id
		));
	}

	//删除管理员前实现管理员角色中间表数据的删除
	protected function _before_delete($options){
		$admin_id=$options['where']['admin_id'];
		M('AdminRole')->where("admin_id=$admin_id")->delete();
	}

	//修改管理员后修改管理员角色中间表数据
	protected function _after_update($data,$options){
		$admin_id=$options['where']['admin_id'];
		$role_id=I('post.role_id')+0;
		$model=M('AdminRole');
		$model->where("admin_id=$admin_id")->delete();
		$model->add(array(
			'admin_id'=>$admin_id,
			'role_id'=>$role_id
		));
	}

	//根据登陆的管理员id的角色对应的权限显示对应的菜单按钮
	public function getButtons(){
		$admin_id=$_SESSION['admin_id'];
		if($admin_id==1){
			//如果是超级管理员显示所有菜单按钮
			//取出顶级权限
			$sql="select * from it_privilege where parent_id=0";
			$arr=M()->query($sql);		//直接查询返回二维数组
			//根据取出的顶级权限获取子级权限
			foreach ($arr as $k => $v) {
				$sql="select * from it_privilege where parent_id=".$v['priv_id'];
				 //将子级权限加入到顶级权限数组的一个字段中
				$arr[$k]['child']=M()->query($sql); 
			}
		}
		else{
			//普通管理员要根据权限显示菜单按钮
			//取出顶级权限
			$sql="select it_privilege.* from it_admin_role left join it_role_privilege
			 using(role_id) left join it_privilege using(priv_id) where 
			 it_admin_role.admin_id=$admin_id and it_privilege.parent_id=0 ";
			$arr=M()->query($sql);
			//根据取出的顶级权限
			foreach ($arr as $k=> $v) {
				$sql="select it_privilege.* from it_admin_role left join it_role_privilege
				 using(role_id) left join it_privilege using(priv_id) where 
				 it_admin_role.admin_id=$admin_id and it_privilege.parent_id=".$v['priv_id'];
				//将子级权限加入到顶级权限数组的一个字段中
				$arr[$k]['child']=M()->query($sql); 
			}
		}
		return $arr;
	}
}
