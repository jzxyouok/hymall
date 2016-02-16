<?php
	/*
	* 角色模型
	*/
namespace Model;
use Think\Model;
class RoleModel extends Model{
	//验证提交的表单字段
	protected $_validate=array(
		array('role_name','require','权限名称不能为空'),
	);
		//表单合法性检测
	 protected $insertFields = array(
	 	'role_name'
	 );  
	 protected $updateFields = array(
	 	'role_name','role_id'
	 );
	 //添加角色后在角色权限关系表中实现增加（给角色分配权限）
	 protected function _after_insert($data,$options){
	 	$priv=I('post.priv');
	 	$role_id=$data['role_id'];
	 	foreach ($priv as $v) {
	 		M('RolePrivilege')->add(array(
	 			'role_id'=>$role_id,
	 			'priv_id'=>$v
	 		));
	 	}
	 }
	 //删除角色之前要实现角色权限表中的数据删除
	 protected function _before_delete($options){
	 	$role_id=$options['where']['role_id'];
	 	M('RolePrivilege')->where("role_id=$role_id")->delete();
	 }

	 //修改角色之前实现权限的修改(删除旧的数据，添加新的数据)
	  protected function _before_update(&$data,$options) {
	  	$role_id=$options['where']['role_id'];
	  	$model=M('RolePrivilege');
	  	$model->where("role_id=$role_id")->delete();
	  	$priv=I('post.priv');
	  	foreach ($priv as $v) {
	 		M('RolePrivilege')->add(array(
	 			'role_id'=>$role_id,
	 			'priv_id'=>$v
	 		));
	 	}
	  }
}