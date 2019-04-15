<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
    	//获取分区信息
    	$parts = M('bbs_part')->select();
    	$parts = array_column($parts,null,'pid');

    	//获取板块信息
    	$cates = M('bbs_cate')->select();

        //获取友情链接信息
        $links = M('bbs_links')->select();

    	foreach($cates as $cate){
    		$parts[ $cate['pid'] ]['sub'][] = $cate;
    	}

    	//分配变量,遍历显示
    	$this->assign('parts',$parts);
        $this->assign('links',$links);

    	//渲染前台模板
        $this->display();
    }
}