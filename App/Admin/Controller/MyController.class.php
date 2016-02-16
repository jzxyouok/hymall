<?php 
namespace Admin\Controller;
use Think\Controller;
class MyController extends Controller{
	//_initialize()会在构造函数中执行
	public function _initialize(){
		//检查是否已经登录，否则跳转到登录页面
		$admin_id=$_SESSION['admin_id'];
		if($admin_id>0){
			//执行权限验证
			if($admin_id==1){
				//超级管理员，执行所有权限
				return true;
			}
			//访问的控制器是Index则放生
			if(strtolower(CONTROLLER_NAME)=='index'){
				return true;
			}
			//开始验证权限
			//取出当前的模块名，控制器名和方法名
			$url=MODULE_NAME.'-'.CONTROLLER_NAME.'-'.ACTION_NAME;
			$sql="select concat(module_name,'-',controller_name,'-',action_name) url from 
			it_admin_role left join it_role_privilege using(role_id) left join it_privilege
			 using(priv_id) where it_admin_role.admin_id=$admin_id having url='$url'";
			$info=M()->query($sql);
			if($info){
				//有记录证明有权限
				return true;
			}
			else{
				$this->error('你越权了');
			}
		}else{
			// 从顶部跳出
			         echo <<<jump
            <script type="text/javascript">
                window.top.location.href='/index.php/Admin/Login/login';
            </script>
jump;
        exit;
		}
	}
}