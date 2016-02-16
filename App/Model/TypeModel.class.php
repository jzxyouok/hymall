<?php
	/*
	* 商品类别模型
	*/
namespace Model;
use Think\Model;
class TypeModel extends Model{
	//字段验证
	 protected $_validate = array(
	 	array('type_name','require','商品类别不能为空！')
	 );
	 //检测提交字段的合法性
	 protected $insertFields=array(
	 	'type_name'
	 );
	  protected $updateFields = array(
	  	'type_name','type_id'
	 );
}