<?php
namespace Home\Controller;

class PostController extends CommonController
{
	//添加发帖内容
	public function create()
	{	
		//判断在登录的标志位是否为true,true表示已经登录可以发帖
		if ( empty($_SESSION['flag']) ) {
			$this->error('你还未登录,请登录后发帖','/index.php?m=home&c=index&a=index');
		}

		$cid = empty($_GET['cid']) ? 0 : $_GET['cid'];

		$links = M('bbs_links')->select();
		$cates = M('bbs_cate')->getField('cid,cname');

		//分配变量,遍历显示
		$this->assign('links',$links);
		$this->assign('cates',$cates);
		$this->assign('cid',$cid);

		//渲染前台发帖表单页面
		$this->display();
	}

	//保存发帖的内容到数据库
	public function save()
	{	
		//接收到url地址栏的cid
		$cid = $_GET['cid'];
		
		//接收表单数据
		$data = $_POST;

		$data['uid'] = $_SESSION['usersInfo']['uid'];
		$data['cid'] = $cid;
		$data['is_display'] = 0;
 
		//创建时间,修改时间
		$data['created_at'] = $data['updated_at'] = time();
 
		$row = M('bbs_post')->where("cid='$cid'")->add( $data );

		if ( $row ) {
			$this->success('发帖成功!',"/index.php?m=home&c=post&a=index&cid=$cid");
		} else {
			$this->error('发帖失败!');
		}
	}

	//显示贴子列表
	public function index()
	{
		//定义空的条件数组
		// $condition = [];

		//判断有没有板块名称
		// if ( !empty($_GET['title']) ) {
		// 	$condition['title'] = ['like',"%{$_GET['title']}%"];
		// }

		//实例化Post对象
		$Post = M('bbs_post');

		// 查询满足要求的总记录数
		$count = $Post->where( $condition )->count();

		// 实例化分页类 传入总记录数和每页显示的记录数(5) 每页显示5条记录
		$Page = new \Think\Page($count,5);

		//获取cid的数值
		$cid = $_GET['cid'];

		//获取数据库is_jing中的数值
		$jings = $Post->getField('pid,is_jing');

		//获取数据库is_jing中的数值
		$display = $Post->getField('pid,is_display');

		//获取数据库is_top中的数值
		$tops = $Post->getField('pid,is_top');

		if ( $tops == 0 ) {
			$posts = $Post->order("is_top desc")->where("cid='$cid'")->limit($Page->firstRow.','.$Page->listRows)->select();
		} else {
			//从数据库中查找数据,并且降序排序
			$posts = $Post->order("is_top asc")->where("cid='$cid'")->limit($Page->firstRow.','.$Page->listRows)->select();

			//$posts = $Post->where( $condition )->limit($Page->firstRow.','.$Page->listRows)->select();
		}

		$links = M('bbs_links')->select();

		//获取user表中的所有uid和uname
		$users = M('bbs_user')->getField('uid,uname');

		//分配变量,遍历显示
		$this->assign('posts',$posts);
		$this->assign('links',$links);
		$this->assign('users',$users);

		$this->assign('jings',$jings);
		$this->assign('display',$display);

		// 分页显示
		$show_page = $Page->show();

		//分配变量,让分页在html页面显示
		$this->assign('show_page',$show_page);


		$this->display();
	}

}