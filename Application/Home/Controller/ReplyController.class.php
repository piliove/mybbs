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
		if ( empty($_SESSION['flagss']) ) {
			$this->error('你还未登陆,请登录..','/');
		}

		//获取表单的全部数值
		$data = $_POST;

		//从表单中获取内容
		$str = $data['rcontent'];

		//列举敏感词汇
		$ptn = "/fuck|god|shit|damn|shut|silly|sick|nmsl|cao/";

		//正则表达式匹配敏感词汇
		$prg = preg_match($ptn, $str);

		$str = strlen($data['rcontent']);

		//判断是否含有敏感词汇
		if ( $prg == true ) {
			
			$this->error('禁止含有敏感词!');
			for($j=1;$j<=$str;$j++){
				echo "*"; 	
			}

		}

		$data['created_at'] = time(); 
		$data['uid'] = $_SESSION['usersInfo']['uid'];

		$row = M('bbs_reply')->add($data);

		if ( $row ) {
			$Post = M('bbs_post')->where('pid='.$data['pid']);

			$Post->setInc('rep_cnt',1);

			$row = $Post->save(['updated_at'=>time()]);	   	

			$this->success('添加回复成功!',"/index.php?m=home&c=reply&a=create&pid=".$data['pid']);
		} else {
			$this->error('添加回复失败!');
		}

	}
}