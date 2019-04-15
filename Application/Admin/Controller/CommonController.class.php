<?php
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		//判断 如果标志位为false那么返回错误信息
		if ( $_SESSION['flag'] == false ) {
			$this->error('你还未登陆','/index.php?m=admin&c=login&a=login');
		}

	}
}