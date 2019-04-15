<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Image;

class UserController extends CommonController
{

	//显示添加用户表单的页面
	public function create()
	{	
		//显示create页面
		$this->display();
	}

	//将接收过来的表单数据添加并存储在数据库中
	public function save()
	{
		
		//接收表单
		$data = $_POST;
		//保存创建时间到表单
		$data['created_at'] = time();

		//用户名不能为空
		if ( empty($data['uname']) || empty($data['uname']) ) {
			$this->error('用户名不能为空!');
		}

		//密码不能为空
		if ( empty($data['upwd']) || empty($data['reupwd']) ) {
			$this->error('密码不能为空!');
		}

		//密码必须一致
		if ( $data['upwd'] !== $data['reupwd'] ) {
			$this->error('密码必须一致!');
		}

		//加密密码(采用哈希法加密)
		$data['upwd'] = password_hash($data['upwd'],PASSWORD_DEFAULT);

		//处理文件上传
		$data['uface'] = $this->doUploads();
		
		//生成缩略图
		$this->doSm();

		//返回受影响的行数
		$row = M('bbs_user') -> add($data);

		if ( $row ) {
			$this->success('添加成功!','/index.php?m=admin&c=user&a=index');
		} else {
			$this->error('添加失败!');
		}

	}

	//查看表单数据
	public function index()
	{

		//多字段查询

		//定义空的条件数组
		$condition = [];

		//判断有没有性别条件
		if ( !empty($_GET['sex']) ) {
			$condition['sex'] = ['eq',"{$_GET['sex']}"];
		}

		//判断有没有姓名条件
		if ( !empty($_GET['uname']) ) {
			$condition['uname'] = ['like',"%{$_GET['uname']}%"];
		}

		// 实例化User对象
		$User = M('bbs_user');

		// 查询满足要求的总记录数
		$count = $User->where( $condition )->count();

		// 实例化分页类 传入总记录数和每页显示的记录数(5) 每页显示5条记录
		$Page = new \Think\Page($count,5);

		//获取数据
		$users = $User->where( $condition )->limit($Page->firstRow.','.$Page->listRows)->select();

		//处理缩略图片
		// foreach($users as $k=>$v){
		// 	$arr = explode('/',$v['uface']);
		// 	$arr[3] = 'sm_'.$arr[3];
		// 	$users[$k]['uface'] = implode('/',$arr);
		// }

		// 分页显示
		$show_page = $Page->show();

		//分配变量,让分页在html页面显示
		$this->assign('show_page',$show_page);

		//分配变量,显示数据
		$this->assign('users',$users);

		$this->display();
	}

	//获得修改表单的数据
	public function edit()
	{
		//获取uid
		$uid = $_GET['uid'];
		$users = M('bbs_user')->find($uid);

		//处理修改页面的缩略图
  		// $arr = explode('/',$users['uface']);
		// $arr[3] = 'sm_'.$arr[3];
		// $users['uface'] = implode('/',$arr);

		//分配变量,遍历显示
		$this->assign('users',$users);
		$this->display();

	}

	//修改表单并存储到数据库中
	public function update()
	{

		//获取用户的uid
		$uid = $_GET['uid'];

		//获取表单数据并将数据赋值给$data
		$data = $_POST;
		
		//判断文件是否有上传,有,则处理
		if ( $_FILES['uface']['error'] !== 4 ){

			//处理上传文件后存入到数据中
			$data['uface'] = $this->doUploads();

			//生成缩略图
			$this->doSm(); 
		}

		//返回受影响的行数
		$row = M('bbs_user')->where("uid = $uid")->save( $data );

		if ( $row ) {
			$this->success('用户信息修改成功!','/index.php?m=admin&c=user&a=index');
		} else {
			$this->error('用户信息修改失败!');
		}

	}

	//删除表单记录
	public function del()
	{

		//获取参数uid
		$uid = $_GET['uid'];
		// 返回受影响的行数
		$row = M('bbs_user')->delete($uid);

		//成功则返回上一页面
		if ( $row ) {
			$this->success('用户信息删除成功');
		} else {
			$this->error('用户信息删除失败');
		}

	}

	//封装文件上传类
	private function doUploads()
	{
		$config = [
			'maxSize'  => 3145728,
			'rootPath' => './',
			'savePath' => 'Public/Uploads/',
			'saveName' => array('uniqid',''),
			'exts'     => array('jpg', 'gif', 'png', 'jpeg'),
			'autoSub'  => true,
			'subName'  => array('date','Ymd'),
		];
		
		// 实例化上传类
		$upload = new \Think\Upload($config);

		// 上传文件
		$info = $upload->upload();
		if ( !$info ) {
			// 上传错误提示错误信息
			$this->error($upload->getError());
		}

		//拼接上传文件
	 	return $this->filename = $info['uface']['savepath'].$info['uface']['savename'];
	}

	// 封装缩略图上传类
	public function doSm()
	{
		// GD库(处理图形的扩展库,要处理的图形名称)
		$image = new Image(Image::IMAGE_GD,$this->filename);

		// 按照原图的比例生成一个最大为150*150的缩略图并保存为$thumb_name
		$image->thumb(100, 100)->save( './'.getSm($this->filename) );
	}

	public function changepass()
	{
		$uid = $_GET['uid'];
		$users = M('bbs_user')->find($uid);

		$this->assign('users',$users);
		$this->display();
	}

	public function inpass()
	{
		$uid = $_GET['uid'];

		$data = $_POST;

		if($data['upwd'] !== $data['reupwd']){
			$this->error('输入两次密码不一致!请重新输入');
		}

		$data['upwd'] = password_hash($data['upwd'], PASSWORD_DEFAULT);

		$row = M('bbs_user')->where("uid = '$uid'")->save($data);

		if ( $row ) {
			$this->success('修改密码成功!','/index.php?m=admin&c=index&a=index');
		} else {
			$this->error('修改密码失败!');
		}
	}

}