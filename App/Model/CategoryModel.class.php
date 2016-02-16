<?php 
	/*
	* 商品栏目模型
	*/
namespace Model;
use Think\Model;
class CategoryModel extends Model{
	//取出栏目的树形数据
	public function getTree(){
		$arr=$this->select();
		return $this->_getTree($arr,$parent_id=0,$lev=0);
	}

	//递归取出带层级效果的栏目数据
	public function _getTree($arr,$parent_id=0,$lev=0){
		static $list=array();
		foreach ($arr as $v) {
			if($v['parent_id']==$parent_id){
				$v['lev']=$lev;			//给记录加一个lev的字段，用来控制层级缩进
				$list[]=$v;
				$this->_getTree($arr,$v['cat_id'],$lev+1);
			}
		}
		return $list;
	}

	//查找自己的下级栏目（子孙级）
	public function getChild($cat_id){
		$arr=$this->select();
		return $this->_getChild($arr,$cat_id);
	}
	//递归取出自己的下级栏目的cat_id
	public function _getChild($arr,$cat_id){
		static $ids=array();
		foreach ($arr as $k => $v) {
			if($v['parent_id']==$cat_id){
				$ids[]=$v['cat_id'];
				$this->_getChild($arr,$v['cat_id']);
			}
		}
		return $ids;
	}

	//查找自身栏目的上级（家谱树）
	public function getFamily($cat_id){
		$arr=$this->select();
		return $this->_getFamily($arr,$cat_id); 
	}
	public function _getFamily($arr,$cat_id){
		static $family=array();
		foreach ($arr as $v) {
			if($v['cat_id']==$cat_id){
				$family[]=$v;
				$this->_getFamily($arr,$v['parent_id']);
			}
		}
		//翻转下返回
		return array_reverse($family);
	}

	//提交字段自动验证
	protected $_validate = array(
		  array('cat_name','require','栏目名称不能为空')
	);
	//表单合法性检测
	 protected $insertFields = array('cat_name','parent_id');
	 protected $updateFields = array('cat_name','parent_id','cat_id');

	// 取出顶级栏目用于前台显示
	public function getNav(){
		return $this->where("parent_id=0")->select();
	}
}
