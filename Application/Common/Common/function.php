<?php

/*
* 功能:缩略图的处理
* 参数:$filename 是指大图片
* 返回缩略图名称
*/
function getSm($filename)
{
	//以"/"截取字符串,以数组形式输出
	$arr = explode('/',$filename);

	//拆分为数组,以 sm_5caeeaba7cd06.jpg 这种格式形式的路径返回
	$arr[3] = 'sm_'.$arr[3];

	//返回处理过的图片路径
	return implode('/', $arr);

}