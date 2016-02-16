<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 商品分类 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css" />
<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/holder.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/application.js"></script>
<style>
    body{
      padding-top: 60px;    /*菜单固定在顶部，内容会钻到下面去，给body加内填充把内容挤下去*/
    }
    th{
      text-align: center;
    }
     .navbar{
      background:rgb(192,220,192);
    }
    .navbar-toggle{
      background: #3c763d;
    }
    .icon-bar{
      background: #FFF;
    }
</style>
</head>
<body>

<div class="navbar navbar_default navbar-fixed-top">
    <!--类navbar-header导航条标题-->
        <div class="navbar-header">
          <!--缩小屏幕显示菜单按钮（响应式的感觉）-->
          <button class="navbar-toggle" data-toggle="collapse" data-target="#myheader">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="" class="navbar-brand">首页</a>
        </div>
        <!--导航条内容id为了跟缩小屏幕是跟显示菜单按钮关联-->
        <div class="collapse navbar-collapse" id="myheader">
          <!--导航栏中ul元素-->
          <ul class="nav navbar-nav">
            <li><a href="">ECSHOP管理中心</a></li>
          </ul>
          <p class="navbar-text" style="font-size:18px">权限列表</p>
          <a href="<?php echo U('add')?>" class="btn btn-default navbar-btn navbar-right" style="margin-right:20px">添加权限</a>
          <p class="navbar-text pull-right" style="font-size:18px">欢迎<a href="#" class="navbar-link"><?php echo $_SESSION['admin_name']?></a>登录</p>
        </div>
    </div>

<form method="post" action="" name="listForm">
<div class="list-div table-responsive" id="listDiv">

<table width="100%" class="table table-striped table-hover table-condensed text-center" id="list-table">
  <tr>
    <th>权限名称</th>
    <th>模块名</th>
    <th>控制器名</th>
    <th>方法名</th>
    <th>操作</th>
  </tr>
      <?php foreach($priv_list as $rows){ ?>
        <tr class="0" id="0_1" id = 'tr_1'>
        <td align="left" class="first-cell" style = 'padding-left="0"'>
              <?php echo str_repeat('&nbsp',$rows['lev']*8)?>
                <img src="/Public/Admin/images/menu_minus.gif" id="icon_0_1" width="9" height="9" border="0" style="margin-left:0em" />

                <span><a href="#" ><?php echo $rows['priv_name']?></a></span>
        </td>
        <td><?php echo $rows['module_name']?></td>
        <td><?php echo $rows['controller_name']?></td>
        <td><?php echo $rows['action_name']?></td>
        <td>
          <a href="<?php echo U('update',array('priv_id'=>$rows['priv_id']))?>">编辑</a> |
          <a href="<?php echo U('del',array('priv_id'=>$rows['priv_id']))?>" onclick="return confirm('确定删除吗')" title="移除">移除</a>
        </td>
      </tr>
        <?php
 }?>
  </table>
</div>
</form>

<div id="footer">
共执行 1 个查询，用时 0.015927 秒，Gzip 已禁用，内存占用 1.999 MB<br />

版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利
。</div>

</body>
</html>
<script type="text/javascript">
  $('tr').addClass('success');
</script>