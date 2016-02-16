<?php
	/*
	* 商品属性模型
	*/
namespace Model;
use Think\Model;
class AttributeModel extends Model{
	//验证提交的字段合法性
	protected $_validate=array(
		//array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间])
		array('attr_name','require','属性名不能为空！'),
		array('type_id','number','商品类型不合法！'),
		array('attr_type',array(0,1),'属性类别不合法！',1,'in'),
		array('attr_input_type',array(0,1),'属性录入不合法！',1,'in'),
	);
	//检测提交字段的合法性
	 protected $insertFields=array(
	 	'attr_name','type_id','attr_type','attr_input_type','attr_value'
	 );
	  protected $updateFields = array(
	  	'attr_name','type_id','attr_type','attr_input_type','attr_value','attr_id'
	 );
}