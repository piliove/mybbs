<?php
namespace Home\Controller;

use Think\Controller;

class PersonController extends CommonController
{
	//个人中心页面
	public function index()
	{
		$uid = $_GET['uid'];

		//获取友情链接的数据
		$links = M('bbs_links')->select();

		//获取用户信息
		$users = M('bbs_user')->find($uid);

		$this->assign('links',$links);
		$this->assign('users',$users);

		//渲染修改个人信息面板
		$this->display();
	}

	public function update()
	{
		$uid = $_GET['uid'];

		$data = $_POST;

		$row = M('bbs_user')->where("uid = '$uid'")->save($data);

		if ( $row ) {
			$this->success('修改成功!',"/");
		} else {
			$this->error('修改失败!');
		}
	}
}