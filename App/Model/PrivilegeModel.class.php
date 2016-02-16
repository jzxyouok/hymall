<?php 
	/*
	* 权限模型
	*/
namespace Model;
use Think\Model;
class PrivilegeModel extends Model{
	//验证提交的表单字段
	protected $_validate=array(
		array('priv_name','require','权限名称不能为空'),
		array('parent_id','number','父级权限编号必须为数字')
	);
	//表单合法性检测
	 protected $insertFields = array(
	 	'priv_name','parent_id','module_name','controller_name','action_name'
	 );  
	 protected $updateFields = array(
	 	'priv_name','parent_id','module_name','controller_name','action_name','priv_id'
	 );
	 //取出层级结构化处理过的权限列表
	 public function getTree(){
	 	$arr=$this->select();
	 	return $this->_getTree($arr,$parent_id=0,$lev=0);
	 }
	 //递归取出格式化后的数据
	 public function _getTree($arr,$parent_id=0,$lev=0){
	 	 static $tree=array();
	 	 foreach ($arr as $k => $v) {
	 	 	if($v['parent_id']==$parent_id){
	 	 		$v['lev']=$lev;		//给记录加入一个lev字段，用来控制层级缩进
	 	 		$tree[]=$v;
	 	 		$this->_getTree($arr,$v['priv_id'],$lev+1);
	 	 	}
	 	 }
	 	 return $tree;
	 }

	 //取出自身的子权限id，防止胡乱修改
	 public function getChild($priv_id){
	 	$arr=$this->select();
	 	return $this->_getChild($arr,$priv_id);
	 }
	 //递归取出自身子权限的id
	 public function _getChild($arr,$priv_id){
	 	static $ids=array();		//定义一个静态空数组，用来保存子级ids
	 	foreach ($arr as $k => $v) {
	 		if($v['parent_id']==$priv_id){
	 			$ids[]=$v['priv_id'];
	 			$this->_getChild($arr,$v['priv_id']);
	 		}
	 	}
	 	return $ids;
	 }

	 //取出自身的父级权限的id，用于自动勾选
	 public function getParents($priv_id){
	 	$arr=$this->select();
	 	return $this->_getParents($arr,$priv_id);
	 }
	 //递归取出自身父级
	 public function _getParents($arr,$priv_id){
	 	static $ids=array();		//定义一个静态空数组，用来保存父级ids
	 	foreach ($arr as $k => $v) {
	 		if($v['priv_id']==$priv_id){
	 			$ids[]=$v['parent_id'];
	 			$this->_getParents($arr,$v['parent_id']);
	 		}
	 	}
	 	return $ids;
	 }
}