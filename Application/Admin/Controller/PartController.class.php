<?php
namespace Admin\Controller;

use Think\Controller;

class PartController extends CommonController
{

	//添加分区
	public function create()
	{
		
		//渲染页面
		$this->display();
	}

	//添加分区,保存数据
	public function save()
	{

		$data = $_POST;
		
		//判断有没有添加分区名		
		if ( !empty($POST['pname']) ) {
			$this->error('分区名称不能为空!');
		}

		//判断有没有添加用户名		
		if ( !empty($POST['partname']) ) {
			$this->error('分区名称不能为空!');
		}

		$row = M('bbs_part')->add($data);

		if ($row) {
			$this->success('添加分区成功!','/index.php?m=admin&c=part&a=index');
		} else {
			$this->error('添加分区失败!');
		}

	}

	//查看所有数据
	public function index()
	{

		//设定一个空数组
		$condition = [];

		//设置模糊查询的匹配字符串
		$condition['pname'] = ['like',"%{$_GET['pname']}%"];

		//实例化User对象
		$User = M('bbs_part');
		
		//进行分页数据查询
		$count = $User->where( $condition )->count();

		// 实例化分页类 传入总记录数和每页显示的记录数(5)
		$Page = new \Think\Page($count,5);

		//显示保存在数据库中的数据
		$parts = $User->where( $condition )->limit($Page->firstRow.','.$Page->listRows)->select();
		
		// 分页显示输出
		$show_page = $Page->show();

		$this->assign('show_page',$show_page);

		//分配变量,遍历显示
		$this->assign('parts',$parts);
		//渲染页面
		$this->display();
	}

	//删除记录
	public function del()
	{
		
		//接收表单传过来的参数pid
		$pid = $_GET['pid'];

		$row = M('bbs_part')->delete($pid);

		if ( $row ) {
			$this->success('删除成功!','/index.php?m=admin&c=part&a=index');
		} else {
			$this->error('删除失败!');
		}

	}

	//显示修改数据页面
	public function edit()
	{

		//接收从表单传过来的参数
		$pid = $_GET['pid'];

		//找到该id下的数据内容
		$parts = M('bbs_part')->find($pid);

		//分配变量,遍历显示
		$this->assign('parts',$parts);
		$this->display();

	}

	//修改数据,保存在数据库中
	public function update()
	{

		//接收参数
		$pid = $_GET['pid'];

		//将数据修改后存回数据库
		$row = M('bbs_part')->where("pid=$pid")->save($_POST);

		//返回受影响的行数
		if ( $row ) {
			$this->success('修改数据成功!','/index.php?m=admin&c=part&a=index');
		} else {
			$this->error('修改数据失败!');
		}

	}

}