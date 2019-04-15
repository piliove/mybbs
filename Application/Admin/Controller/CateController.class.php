<?php
namespace Admin\Controller;

use Think\Controller;

class CateController extends CommonController
{

	//添加板块
	public function create()
	{

		$cates = M('bbs_cate')->select();

		//获取所有分区
	 	$parts = M('bbs_part')->select();

	 	//获取所有指定版主,设置限定条件
	 	$users = M('bbs_user')->where("auth<3")->select();

	 	//分配变量,遍历显示
	 	$this->assign('cates',$cates);
	 	$this->assign('parts',$parts);
	 	$this->assign('users',$users);

		//渲染添加表单页面
		$this->display();
	}

	public function save()
	{

		$_POST['create_times'] = time();

		//返回受影响的行数
		$row = M('bbs_cate')->add($_POST);

		if($row){
			$this->success('添加板块成功!','/index.php?m=admin&c=cate&a=index');
		} else{
			$this->error('添加板块失败!');
		}

	}

	//查看板块
	public function index()
	{

		//定义一个空数组
		$condition = [];

		//如果能拿到板块名,就执行
		if ( !empty($_GET['cname']) ) {
			$condition['cname'] = ['like',"%{$_GET['cname']}%"]; 
		}

		//实例化User对象
		$User = M('bbs_cate');

		// 查询满足要求的总记录数
		$count = $User->where( $condition )->count();
		
		// 实例化分页类 传入总记录数和每页显示的记录数(5)
		$Page = new \Think\Page($count,5);

		//获取数据
		$cates = $User->where( $condition )->limit($Page->firstRow.','.$Page->listRows)->select();

		// 分页显示输出
		$show_page = $Page->show();

		//获取分区信息
		$parts = M('bbs_part')->select();
		$parts = array_column($parts,'pname','pid');

		//获取用户信息
		$users = M('bbs_user')->select();
		$users = array_column($users,'uname','uid');

		//分页遍历显示
		$this->assign('show_page',$show_page);

		//遍历显示
		$this->assign('cates',$cates);
		$this->assign('parts',$parts);
		$this->assign('users',$users);

		//渲染表单页面
		$this->display();
	}

	//删除板块
	public function del()
	{

		//接收到表单传过来的参数(id)
		$cid = $_GET['cid'];

		//从数据库中删除
		$row = M('bbs_cate')->delete($cid);

		//返回受影响的行数
		if($row){
			$this->success('删除记录成功!');
		} else{
			$this->error('删除记录失败!');
		}

	}

	//修改板块
	public function edit()
	{	
		//接收参数cid
		$cid = $_GET['cid'];

		//在数据库中找到cid的数据
		$cates = M('bbs_cate')->find($cid);

		//显示part表中的数据
		$parts = M('bbs_part')->select();

		//显示权限小于3的管理员
		$users = M('bbs_user')->where("auth<3")->select();

		//分配变量,遍历数据
		$this->assign('cates',$cates);
		$this->assign('parts',$parts);
		$this->assign('users',$users);

		//渲染修改表单页面
		$this->display();
	}

	public function update()
	{

	}

}