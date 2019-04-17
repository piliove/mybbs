<?php
namespace Admin\Controller;

class PostController extends CommonController
{

	public function index()
	{	
		$condition = [];

		// 实例化User对象
		$User = M('bbs_post');

		//判断有没有标题条件
		if ( !empty($_GET['title']) ) {
			$condition['title'] = ['like',"%{$_GET['title']}%"];
		}

		// 查询满足要求的总记录数
		$count = $User->where( $condition )->count();
		
		// 实例化分页类 传入总记录数和每页显示的记录数(5)
		$Page = new \Think\Page($count,5);

		//从数据库中查找数据
		$posts = $User->where( $condition )->limit($Page->firstRow.','.$Page->listRows)->select();

		$users = M('bbs_user')->select();
		$users = array_column($users,'uname','uid');

		// 分页显示输出
		$show = $Page->show();

		//分配变量,数组遍历
		$this->assign('posts',$posts);
		$this->assign('users',$users);
		$this->assign('show',$show);

		//渲染页面
		$this->display();
	}

	public function edit()
	{
		//获取表单中的pid
		$pid = $_GET['pid'];

		//从数据库中查找
		$post = M('bbs_post')->find($pid);

		//从数据库中查找
		$users = M('bbs_user')->select();
		$users = array_column($users,'uname','uid');

		//分配变量,遍历显示
		$this->assign('post',$post);
		$this->assign('users',$users);

		//渲染表单页面
		$this->display();
	}

	public function update()
	{
		//获取url传来的参数id
		$pid = $_GET['pid'];

		//获取表单提交的数据
		$data = $_POST;

		//数据库操作,修改
		$row = M('bbs_post')->where("pid = $pid")->save($data);

		if ( $row ) {
			$this->success('修改成功!','/index.php?m=admin&c=post&a=index');
		} else {
			$this->error('修改失败!');
		}
	}

	public function del()
	{
		$pid = $_GET['pid'];
		
		$condition['pid'] = $pid;

		//数据库操作,删除
		$row1 = M('bbs_post')->where( $condition )->delete();
		$row2 = M('bbs_reply')->where( $condition )->delete();

		if ( $row1 !== false && $row2 !== false ) {
			$this->success('删除成功!','/index.php?m=admin&c=post&a=index');
		} else {
			$this->error('删除失败!');
		}
	}

	//设置加精方法
	public function setJing()
	{
		$pid = $_GET['pid'];
		
		M('bbs_post')->where("pid = $pid")->save(['is_jing'=>1]);

		//重定向
		redirect('/index.php?m=admin&c=post&a=index');
	}

	//设置取消加精方法
	public function setNotJing()
	{
		$pid = $_GET['pid'];
		
		M('bbs_post')->where("pid = $pid")->save(['is_jing'=>0]);

		redirect('/index.php?m=admin&c=post&a=index');
	}

	//设置置顶方法
	public function setTop()
	{
		$pid = $_GET['pid'];

		M('bbs_post')->where("pid = $pid")->save(['is_top'=>1]);

		redirect('/index.php?m=admin&c=post&a=index');
	}

	//设置取消置顶方法
	public function setNotTop()
	{
		$pid = $_GET['pid'];
		
		M('bbs_post')->where("pid = $pid")->save(['is_top'=>0]);

		redirect('/index.php?m=admin&c=post&a=index');
	}

	//设置隐藏方法
	public function displays()
	{
		$pid = $_GET['pid'];

		M('bbs_post')->where("pid = $pid")->save(['is_display'=>1]);

		redirect('/index.php?m=admin&c=post&a=index');
	}

	//设置显示方法
	public function notdisplays()
	{
		$pid = $_GET['pid'];

		M('bbs_post')->where("pid = $pid")->save(['is_display'=>0]);

		redirect('/index.php?m=admin&c=post&a=index');
	}
}