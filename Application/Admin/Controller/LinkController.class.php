<?php
namespace Admin\Controller;

use Think\Controller;

class LinkController extends CommonController
{

	//显示添加操作的页面
	public function create()
	{
		$this->display();
	}

	//保存数据到数据库中
	public function save()
	{
		//接收从表单传过来的数据
		$data = $_POST;

		//增加创建时间
		$data['create_time'] = time();

		//判断表单填写的标题不能为空
		if(empty($_POST['title'])){
			$this->error('标题不能为空');
		}

		//判断发布人不能为空
		if(empty($_POST['uname'])){
			$this->error('发布人不能为空');
		}

		//判断内容不能为空
		if(empty($_POST['contents'])){
			$this->error('内容不能为空');
		}

		//传入数据中
		$data['pics'] = $this->Uploads();

		//处理缩略图
		$this->doSm();

		$row = M('bbs_links')->add($data);

		if($row){
			$this->success('上传成功!','/index.php?m=admin&c=link&a=index');
		}else{
			$this->error('上传失败!');
		}

	}

	//显示添加友情链接的页面
	public function index()
	{

		//返回一个空数组
		$condition = [];

		// 如果查询的用户名不为空则执行
		if ( !empty($_GET['uname']) ){
			$condition['uname'] = ['like',"%{$_GET['uname']}%"];
		}

		//实例化User对象
		$User = M('bbs_links');

		// 查询满足要求的总记录数
		$count = $User->where( $condition )->count();

		// 实例化分页类 传入总记录数和每页显示的记录数(5)
		$Page = new \Think\Page($count,3);

		// 分页显示输出
		$show = $Page->show();

		//查询数据库中的内容
		$users =$User
				->where( $condition )
				->limit($Page->firstRow.','.$Page->listRows)
				->select();

		//分页遍历
		$this->assign('show',$show);
		//分配变量,遍历显示
		$this->assign('users',$users);

		$this->display();

	}

	//删除数据操作
	public function del()
	{

		//获取表单中传递的uid参数
		$uid = $_GET['uid'];

		//从数据库中删除
		$row = M('bbs_links')->delete($uid);

		//返回受影响的行数
		if ($row) {
			$this->success('删除成功!');
		} else {
			$this->error('删除失败!');
		}

	}

	//显示修改数据页面
	public function edit()
	{

		//获取表单传递过来的uid
		$uid = $_GET['uid'];

		//进行数据库查找记录操作
		$links = M('bbs_links')->find($uid);

		//分配变量,遍历显示
		$this->assign('links',$links);

		//渲染修改表单页面
		$this->display();

	}

	//修改数据
	public function update()
	{	
		$uid = $_GET['uid'];

		$links = $_POST;

		$row = M('bbs_links')->where("uid = $uid")->save($links);

		if ( $row ) {
			$this->success('修改信息成功!','/index.php?m=admin&c=link&a=index');
		} else {
			$this->error('修改信息失败!');
		}

	}

	//处理文件上传类
	private function Uploads()
	{

		$config = array(
						'maxSize' => 3145728,
						'rootPath' => './',
						'savePath' => 'Public/Uploadlinks/',
						'saveName' => array('uniqid',''),
						'exts' => array('jpg', 'gif', 'png', 'jpeg'),
						'autoSub' => true,
						'subName' => array('date','Ymd'),
		);

		// 实例化上传类
		$upload = new \Think\Upload($config);

		$info = $upload->upload();
		if ( !$info ) {
			// 上传错误提示错误信息
			$this->error($upload->getError());
		}

		// 保存当前数据对象
		return $this->filename = $info['pics']['savepath'].$info['pics']['savename'];

	}

	public function doSm()
	{
		 // GD库(处理图形的扩展库,要处理的图形名称)
		$image = new \Think\Image(\Think\Image::IMAGE_GD,$this->filename);

		// 按照原图的比例生成一个最大为150*150的缩略图并保存为$thumb_name
		$image->thumb(100, 100)->save( './'.getSm($this->filename) );
	}


}