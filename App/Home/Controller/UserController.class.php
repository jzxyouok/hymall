<?php 
namespace Home\Controller;
use Think\Controller;
class UserController extends MyController{
	//用户注册方法
	public function register(){
		//完成注册，注册完成发送一封激活邮件
		if(IS_POST){
			$model=new \Model\UserModel();
			if($data=$model->create()){
				$validate=uniqid();
				$data['validate']=$validate;
				if($model->add($data)){
					//注册成功，发送邮件激活
					$email=I('post.email');
					$title='注册用户，完成激活';
					$url="http://web.com/index.php/Home/User/active/key/".$validate.
					"/email/".$email;
					$content="亲，您已注册成功，赶紧激活使用吧！请<a href='$url'>单击激活</a>";
					if(sendEmail($email,$content,$title)){
						$this->success('邮件发送成功，请尽快激活',U('login'),1);
						exit;
					}
					$this->error('发送邮件失败，请重新注册');
				}
				$this->error('注册失败');
			}
			$this->error($model->getError());
		}

		$this->display();
	}

	//用户登陆
	public function login(){
    	//实现登陆
    	if(IS_POST){
    		$model=new \Model\UserModel();
	    	if($model->login()){
	    		$url=empty($_SESSION['return_url'])?'Index/index':$_SESSION['return_url'];
	    		//用户登陆成功调用转移cookie中购物车的数据入数据库
	    		$cart_model=new \Model\CartModel();
	    		$cart_model->cookie2db();
	    		$this->success('登陆成功',U($url),1);
	    		exit;
	    	}
	    	$this->error($model->getError());
	    }
    	$this->display();
	}

	//用户注册激活
	public function active(){
		$key=$_GET['key'];
		$email=$_GET['email'];
		$model=new \Model\UserModel();
		$info=$model->where("email='$email'")->find();
		if(!$info){
			//匹配不到用户
			$this->error('激活失败',U('login'),2);
		}
		if($key!=$info['validate']){
			$this->error('激活失败',U('login'),2);
		}
		//如果已经激活，则不用再激活
		if($info['active']==1){
			$this->success('已完成激活，无需再次激活',U('login'),1);
			exit;
		}
		//开始激活setField(修改字段)
		$rs=$model->where("email='$email'")->setField('active',1);
		if($rs){
			//激活成功，提示跳转
			$this->success('激活成功，体验非一般的感觉吧',U('login'),1);
			exit;
		}
		$this->error('激活失败，请重新激活',U('login'),2);
	}

	//用户退出功能
	public function logout(){
		session(null);			//清空会话
		$this->success('成功退出...',U('Index/index'),1);
	}
}