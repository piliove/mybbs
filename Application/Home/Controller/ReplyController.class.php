<?php
namespace Home\Controller;

class ReplyController extends CommonController
{
	public function create()
	{
		//查找友情链接表的数据
		$links = M('bbs_links')->select();

		//获取链接传过来的参数ID
		$pid = $_GET['pid'];

		//从数据库中找出该id数据
		$posts = M('bbs_post')->find($pid);

		$replys = M('bbs_reply')->where("pid = '$pid'")->select();

		//查找user表中的数据
		$users = M('bbs_user')->select();

		//获取user所有的数据,uid对应
		$users = array_column($users, null,'uid');

		M('bbs_post')->where('pid='.$posts['pid'])->setInc('view_cnt',1);

		//分配变量,遍历显示
		$this->assign('links',$links);
		$this->assign('posts',$posts);
		$this->assign('users',$users);
		$this->assign('replys',$replys);

		$n = 1;
		//渲染模板
		$this->display();
	}

	public function save()
	{
		//判断是否登录,需登录后发帖
		if ( empty($_SESSION['flag']) ) {
			$this->error('你还未登陆,请登录..','/');
		}

		//获取表单的全部数值
		$data = $_POST;
		$data['created_at'] = time(); 
		$data['uid'] = $_SESSION['usersInfo']['uid'];

		$row = M('bbs_reply')->add($data);

		if ( $row ) {
			$post = M('bbs_post')->where('pid='.$data['pid']);
			$row = $post->save(['updated_at'=>time()]);
			$post->setInc('rep_cnt',1);
			if ( !$row ) {
				die('更新帖子失败!');
			}
			$this->success('添加回复成功!',"/index.php?m=home&c=reply&a=create&pid=".$data['pid']);
		} else {
			$this->error('添加回复失败!');
		}

	}
}