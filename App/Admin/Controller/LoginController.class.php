<?php 
	/*
	* 管理员登陆控制器
	*/
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
	//验证登陆
	public function login(){
		$model=new \Model\AdminModel;
		if(IS_POST){
			if($model->validate($model->login_rules)->create()){
				if($model->login()){
					$this->success('登录成功',U('Index/index'),1);
					exit;
				}
			}
				
			$this->error($model->getError());	//获取自动验证和模型中error属性的错误信息
		}
		$this->display();
	}

	//生成验证码
	public function getCode(){
		$config = array(    
		'fontSize'  =>    15,    // 验证码字体大小
		'length'    =>    2,     // 验证码位数 
		'useNoise'  =>    false, // 关闭验证码杂点
		'imageW'=>142,			
		'imageH'=>25
		);
		$Verify = new \Think\Verify($config);
		$Verify->entry();
	}

	//退出功能
	public function logout(){
		session(null);              //清空会话,从顶部跳出
         echo <<<jump
            <script type="text/javascript">
                window.top.location.href='/index.php/Admin/Login/login';
            </script>
jump;
        exit;
	}
}