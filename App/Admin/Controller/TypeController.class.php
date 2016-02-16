<?php 
	/*
	* 商品类别控制器
	*/
namespace Admin\Controller;
use Think\Controller;
class TypeController extends MyController{
	//添加商品类别
	public function add(){
		if(IS_POST){
			$model=new \Model\TypeModel();
			if($data=$model->create(I('post.'),1)){
				if($model->add($data)){
					$this->success('添加成功',U('showlist'),1);
					exit;
				}
				else{
					$this->error('添加失败');
				}
			}	
			else{
				$this->error($model->getError());
			}
		}
		$this->display();
	}
	//显示商品类别
	public function showlist(){
		$model=new \Model\TypeModel();
		//获取总记录数
		$count=$model->count();
		//获取页面大小
		$pagesize=C('pagesize');
		//实例化分页类
		$page= new \Think\Page($count,$pagesize);
		//设置分页样式
		$page->lastSuffix=false;    //不显示末页
        $page->rollPage   = 3;      //一次显示三页
        $page->setConfig('prev', '【上一页】');
        $page->setConfig('next', '【下一页】');
        $page->setConfig('first', '【首页】');
        $page->setConfig('last', '【末页】');
        $page->setConfig('theme', '共 %TOTAL_ROW% 条记录,当前 %NOW_PAGE%/%TOTAL_PAGE%%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//调用分页显示方法
		$pageinfo=$page->show();
		//获取页面数据
		$list=$model->order('type_id desc')->limit($page->firstRow.','.$page->listRows)->select();
		//获取当前页方便跳转
		$nowpage=$page->nowPage;
		//视图显示
		$this->assign('list',$list);
		$this->assign('pageinfo',$pageinfo);
		$this->assign('nowpage',$nowpage);
		$this->display();
	}
	//删除商品类别
	public function del($type_id){
		$type_id=(int)$type_id;
		$pageno=(int)$_GET['p'];
		$model=M('type');
		if($model->delete($type_id)!==false){
			$this->redirect('showlist',array('p'=>$pageno),1,'删除成功...');
		}
		else{
			$this->redirect('showlist',array('p'=>$pageno),3,'删除失败...');
		}
	}
	//修改商品类别
	public function update($type_id){
		$type_id=(int)$type_id;
		$pageno=(int)$_GET['p'];
		if(IS_POST){
			$model=new \Model\TypeModel();
			if($data=$model->create(I('post.'),2)){
				if($model->save($data)!==false){
					$this->redirect('showlist',array('p'=>$pageno),1,'修改成功...');
					exit;
				}
				else{
					$this->redirect('showlist',array('p'=>$pageno),3,'修改失败...');
					exit;
				}
			}
			else{
				$this->error($model->getError());
			}
		}
		$info=M('type')->find($type_id);
		$this->assign('info',$info);
		$this->display();
	}
}