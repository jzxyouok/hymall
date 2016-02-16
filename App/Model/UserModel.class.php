<?php 
namespace Model;
use Think\Model;
class UserModel extends Model{
	//验证提交表单的合法性
	protected $_validate=array(
		//array(验证字段2,验证规则,错误提示,[验证条件,附加规则,验证时间]),
		array('username','require','用户名不能为空'),
		array('username','','用户名已存在',1,'unique'),
		//排除一些特殊字符
		array('username','checkName','用户名不能有特殊字符',1,'callback'),
		array('password','6,12','密码必须为6到12位',1,'length'),
		array('rpassword','password','两次密码输入不一致',1,'confirm'),
		array('email','email','邮箱格式不正确'),
		array('question','require','问题不能为空'),
		array('answer','require','答案不能为空'),
	);
	//验证用户名，排除某些特殊字符
	protected function checkName($name){
		if(strpos($name,'@')!==false || strpos($name,'#')!==false || strpos($name,'*')!==false){
			return false;
		}
		return true;
	}
	//定义一个用户登陆的方法，实现用户登陆,未激活的账号不允许登陆
	public function login(){
		$username=I('post.username');
		$password=I('post.password');
		$info=$this->where("username='$username'")->find();
		if($info){
			//匹配到用户检测是否激活
			if($info['active']==0){
			$this->error='用户未激活，无法登陆';	//将错误信息赋值到error属性中,返回false
			return false;
			}
			//激活过判断密码是否匹配
			if($info['password']==$password){
				//将用户信息记录到session中
				$_SESSION['username']=$username;
				$_SESSION['user_id']=$info['user_id'];
				return true;
			}
		}
		$this->error='用户名或者密码错误';			//将错误信息赋值到error属性中,返回false
		return false;
	}
}