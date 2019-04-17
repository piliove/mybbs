<?php
namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller
{
	public function Login()
	{
		// 渲染登录页面
		$this->display();
	}

	public function doLogin()
	{
		//接收到表单的数据
		$uname = $_POST['uname'];
		$upwd  = $_POST['upwd'];

		//从数据库中找到相应数据
		$users = M('bbs_user')->where("uname = '$uname'")->find();

		$_SESSION['usersInfo'] = $users;
		//返回一个true标志位,登录true
		$_SESSION['flagss']      = true;

		//验证密码
		if ( $users && password_verify($upwd,$users['upwd']) ) {
			$this->success('登录成功!','/index.php?m=home&c=index&a=index');
		} else {
			$this->error('登录失败!');
		}
	}

	public function logout()
	{
		//返回一个标志位,退出 false
		$_SESSION['flagss'] = false;
		$this->success('退出登录成功!','/');
	}
}