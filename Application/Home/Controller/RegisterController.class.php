<?php
namespace Home\Controller;

use Think\Controller;

class RegisterController extends Controller
{

	public function register()
	{
		//渲染注册表单页面
		$this->display();
	}

	public function doRegister()
	{

		//接收表单传来的数据
		$users = $_POST;	

		//得到时间戳返回创建时间给数据库
		$users['created_at'] = time();

		//判断用户名是否为空
		if ( empty($users['uname']) ) {
			$this->error('用户名不能为空!');
		}

		//判断账号密码是否为空
		if ( empty($users['upwd'] && $users['reupwd']) ) {
			$this->error('密码不能为空!');
		}

		//判断手机号码是否为空
		if ( empty($users['tel']) ) {
			$this->error('手机号码不能为空!');
		}

		//判断是否属于手机号码(正则验证)
		

		//判断账号密码是否一致
		if ( $users['upwd'] !== $users['reupwd'] ) {
			$this->error('输入两次密码不一致');
		}

		//密码加密
		$users['upwd'] = password_hash($users['upwd'], PASSWORD_DEFAULT);

		//返回受影响的行数
		$row = M('bbs_user')->where("auth=3")->add($users);

		if ( $row ) {
			$this->success('注册成功','/index.php?m=home&c=index&a=index');
		} else {
			$this->error('注册失败');
		}

	}


}