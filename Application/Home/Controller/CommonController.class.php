<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller
{
	public function Index()
	{
		//获取友情链接信息
        $links = M('bbs_links')->select();

        //分配变量,遍历显示
        $this->assign('links',$links);

        //渲染面板
        $this->display();
	}

}