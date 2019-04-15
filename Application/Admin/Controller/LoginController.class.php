<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
	//用户登录
	public function login()
	{
		//渲染登录界面
		$this->display();
	}

	//获取表单的数据并验证其登录
	public function dologin()
	{
		//接收表单传来的账号与密码
		$uname    = $_POST['uname'];
		$password = $_POST['upwd'];
		$code     = $_POST['code'];

		//验证码检测
		$verify = new \Think\Verify();
		if ( !$verify->check($code) ){
			$this->error('验证码有误');
		}
		
		//查找到uname的全部信息
		$users = M('bbs_user')->where("uname = '$uname'")->find();

		//登录账户与密码的验证
		if ( $users && password_verify($password,$users['upwd']) ) {

			//从服务器端获取用户名与它的权限
			$_SESSION['userInfo'] = $users;

			//判断一下账户的角色
			if ( $users['auth'] == 1 ){
				$_SESSION['authInfo'] = '超级管理员';
			} else if( $users['auth'] == 2 ){
				$_SESSION['authInfo'] = '管理员';
			} else if( $users['auth'] == 3 ){
				$_SESSION['authInfo'] = '用户';
			}

			//返回一个标志位
			$_SESSION['flag'] = true;

			//登录成功 则返回信息并跳至首页
			$this->success('登录成功!','index.php?m=admin&c=index&a=index');
		} else {

			//登录失败则弹出提示信息
			$this->error('账号或密码错误');
		}	

	}

	//用户登出
	public function logout()
	{
		//注销session信息
		$_SESSION['userInfo'] = NULL;
		$_SESSION['authInfo'] = NULL;
		$_SESSION['flag']     = false;

		//返回登出成功提示信息
		$this->success('正在退出...','/index.php?m=admin&c=login&a=login');
	}

	//验证码验证登陆
	public function code()
	{
		
		//实例化传入参数
		$config = array(

						// 验证码字体大小
						'fontSize' => 20,
						// 验证码位数
						'length'   => 3,
						// 关闭验证码杂点
						'useNoise' => false,
						//设置宽
						'imageW'   => 120,
						//设置高
						'imageH'   => 38,
		);

		//最简单的生成验证码的方式
		$Verify = new \Think\Verify($config);
		$Verify->entry();

	}

}