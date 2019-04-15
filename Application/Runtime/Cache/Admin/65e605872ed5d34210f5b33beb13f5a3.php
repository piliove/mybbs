<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/> -->
    <script type="text/javascript" src="/Public/Admin/js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="/index.php?m=admin&c=index&a=index">首页</a></li>
                <li><a href="/index.php?m=home&c=index&a=index" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><?=$_SESSION['userInfo']['uname']?></li>
                <li><a href="/index.php?m=admin&c=user&a=index"><?=$_SESSION['authInfo']?></a></li>
                <li><a href="/index.php?m=admin&c=user&a=changepass&uid=<?=$_SESSION['userInfo']['uid']?>">修改密码</a></li>
                <li><a href="/index.php?m=admin&c=login&a=logout">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>用户管理</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php?m=admin&c=user&a=create"><i class="icon-font">&#xe008;</i>添加用户</a></li>
                        <li><a href="/index.php?m=admin&c=user&a=index"><i class="icon-font">&#xe005;</i>查看用户</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>分区管理</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php?m=admin&c=part&a=create"><i class="icon-font">&#xe017;</i>添加分区</a></li>
                        <li><a href="/index.php?m=admin&c=part&a=index"><i class="icon-font">&#xe037;</i>查看分区</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>板块管理</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php?m=admin&c=cate&a=create"><i class="icon-font">&#xe017;</i>添加板块</a></li>
                        <li><a href="/index.php?m=admin&c=cate&a=index"><i class="icon-font">&#xe037;</i>查看板块</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>链接管理</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php?m=admin&c=link&a=create"><i class="icon-font">&#xe008;</i>增加链接</a></li>
                        <li><a href="/index.php?m=admin&c=link&a=index"><i class="icon-font">&#xe008;</i>查看链接</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>贴子管理</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php?m=admin&c=post&a=index"><i class="icon-font">&#xe008;</i>查看贴子</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    
	<div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/index.php?m=admin&c=index&a=index">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">用户管理</span></div>
        </div>
        <!-- 搜索查询 -->
        <div class="search-wrap">
            <div class="search-content">
                <form action="/index.php?m=admin&c=user&a=index" method="get">
                    <input type="hidden" name="m" value="admin">
                    <input type="hidden" name="c" value="user">
                    <input type="hidden" name="a" value="index">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select name="sex" id="">
                                    <option value="">全部</option>
                                    <option value="w">女</option>
                                    <option value="m">男</option>
                                    <option value="x">保密</option>
                                </select>
                            </td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="uname" value="" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="/index.php?m=admin&c=user&a=create"><i class="icon-font"></i>新增用户</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th style="text-align:center;">用户ID</th>
                            <th style="text-align:center;">权限</th>
                            <th style="text-align:center;">姓名</th>
                            <th style="text-align:center;">头像</th>
                            <th style="text-align:center;">性别</th>
                            <th style="text-align:center;">创建时间</th>
                            <th style="text-align:center;">操作</th>
                        </tr>
                        <?php foreach($users as $k =>$v): ?>
                        <tr>
                            <td class="tc"><input name="id[]" value="58" type="checkbox"></td>
                            <td align="center"><?=$v['uid'];?></td>
                            <td align="center">
                            	<?php  if($v['auth']==1){ echo '超级管理员'; } else if($v['auth']==2){ echo '管理员'; } else if($v['auth']==3){ echo '用户'; } ?>
                            </td>
                            <td align="center"><?=$v['uname'];?></td>
                            <td align="center">
                                <img src="/<?=getSm($v['uface']);?>" >       
                            </td>
                            <td align="center">
                            	<?php  if($v['sex']=='w'){ echo '女'; } else if($v['sex']=='m'){ echo '男'; } else if($v['sex']=='x'){ echo '保密'; } ?>
                            </td>
                            <td align="center"><?=date('Y-m-d H:i:s',$v['created_at']); ?></td>
                            <td align="center">
                                <a class="link-update" href="/index.php?m=admin&c=user&a=edit&uid=<?=$v['uid'];?>">修改</a>
                                <a class="link-del" href="/index.php?m=admin&c=user&a=del&uid=<?=$v['uid'];?>">删除</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <div class="list-page"><?=$show_page?></div>
                </div>
            </form>
        </div>
    </div>

    <!--/main-->
</div>
</body>
</html>