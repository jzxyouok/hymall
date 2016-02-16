<?php 
	/*
	* 后台显示控制器
	*/
namespace Admin\Controller;
use Think\Controller;
class IndexController extends MyController{
	public function index(){
		$this->display();
	}

	public function top(){
		$this->display();
	}

	public function drag(){
		$this->display();
	}

	public function left(){
		$model=new \Model\AdminModel();
		$list=$model-> getButtons();
		$this->assign('list',$list);
		$this->display();
	}

	public function main(){
		$this->display();
	}
}