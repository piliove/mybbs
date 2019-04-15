<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends CommonController
{
    public function index()
    {
    	//后台页面渲染
        $this->display();
    }

}