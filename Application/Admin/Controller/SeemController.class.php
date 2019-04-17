<?php
namespace Admin\Controller;

class SeemController extends CommonController
{
	//显示查看回复表单页面
	public function index()
	{
		//多字段查询
		//定义空的条件数组
		$condition = [];

		//判断有没有内容条件
		if ( !empty($_GET['rcontent']) ) {
			$condition['rcontent'] = ['like',"%{$_GET['rcontent']}%"];
		}

		// 实例化User对象
		$Replys = M('bbs_reply');

		// 查询满足要求的总记录数
		$count = $Replys->where( $condition )->count();

		// 实例化分页类 传入总记录数和每页显示的记录数(5) 每页显示5条记录
		$Page = new \Think\Page($count,5);

		//获取数据
		$replys = $Replys->where( $condition )->limit($Page->firstRow.','.$Page->listRows)->select();

		// 分页显示
		$show_page = $Page->show();

		//找到所有user的数据,组合
		$users = M('bbs_user')->select();
		$users = array_column($users,'uname','uid');

		$posts = M('bbs_post')->select();
		$posts = array_column($posts,'title','pid');

		//分配变量,遍历显示
		$this->assign('replys',$replys);
		$this->assign('users',$users);
		$this->assign('posts',$posts);

		//分配变量,让分页在html页面显示
		$this->assign('show_page',$show_page);

		//渲染页面
		$this->display();
	}

	public function del()
	{
		// 获取url参数id
		$rid = $_GET['rid'];

	 	$row = M('bbs_reply')->delete($rid);

	 	if ( $row ) {
	 		$this->success('删除成功!');
	 	} else {
	 		$this->error('删除失败!');
	 	}
	}
}
