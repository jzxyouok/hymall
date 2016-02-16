<?php 
	/*
	* 商品栏目控制器
	*/
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends MyController{
	//添加商品栏目
	public function add(){
		$model=new \Model\CategoryModel();
		if(IS_POST){
			if($data=$model->create(I('post.'),1)){
				if($model->add($data)){
					$this->success('添加商品栏目成功',U('showlist'),1);
					exit;
				}
				else{
					$this->error('添加商品栏目失败');
				}	
			}else{
				$this->error($model->getError());
			}
		}
		//取出商品栏目
		$cat_list=$model->getTree();
		$this->assign('cat_list',$cat_list);
		$this->display();
	}

	//显示商品栏目
	public function showlist(){
		//取出商品栏目
		$model=new \Model\CategoryModel();
		$cat_list=$model->getTree();
		$this->assign('cat_list',$cat_list);
		$this->display();
	}

	//删除商品栏目
	public function del($cat_id){
		$cat_id=(int)$cat_id;
		$model=M('category');
		$info=$model->where("parent_id=$cat_id")->select();
		if($info){
			$this->error('删除的栏目有子栏目，不予删除',U('showlist'),2);
		}
		if($model->delete($cat_id)!==false){
			$this->success('删除成功',U('showlist'),1);
		}
		else{
			$this->error('删除失败',U('showlist'),2);
		}
	}

	//修改商品栏目
	public function update($cat_id){
		$cat_id=(int)$cat_id;
		$model=new \Model\CategoryModel();
		if(IS_POST){
			if($data=$model->create(I('post.'),2)){
				//查找自身和下级的cat_id，防止修改表单恶意提交（将自身或者下级作为自身的父级）
				$ids=$model->getChild($cat_id);
				$ids[]=$cat_id;
				$parent_id=(int)I('post.parent_id');
				if(in_array($parent_id,$ids)){
					$this->error('不能讲自身和下级栏目作为自身的父级');
				}
				if($model->save($data)!==false){
					$this->success('修改成功',U('showlist'),1);
					exit;
				}
				else{
					$this->error('修改失败');
				}
			}else{
				$this->error($model->getError());
			}
		}
		//取出要修改栏目的信息
		$info=$model->find($cat_id);
		$this->assign('info',$info);
		//取出要修改的栏目的自身和下级栏目，在修改界面不显示
		$ids=$model->getChild($cat_id);
		$ids[]=$cat_id;	
		$this->assign('ids',$ids);
		//取出商品栏目
		$cat_list=$model->getTree();
		$this->assign('cat_list',$cat_list);
		$this->display();
	}
}