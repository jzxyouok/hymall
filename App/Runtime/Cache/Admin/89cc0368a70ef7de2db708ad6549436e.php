<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 商品列表 </title>
<meta name="robots" c>
<meta http-equiv="Content-Type" c />
<link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css" />
<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/holder.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/application.js"></script>
<style>
    body{
      padding-top: 70px;    /*菜单固定在顶部，内容会钻到下面去，给body加内填充把内容挤下去*/
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

 <div class="navbar navbar-fixed-top">
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
          <p class="navbar-text" style="font-size:18px">商品属性</p>
          <a href="<?php echo U('add')?>" class="btn btn-default navbar-btn navbar-right" style="margin-right:20px">添加商品属性</a>
          <p class="navbar-text pull-right" style="font-size:18px">欢迎<a href="#" class="navbar-link">掌门人</a>登录</p>
        </div>
    </div>

<div class="form-div">
<!-- jquery完成下拉菜单查询 -->
<script type="text/javascript">
  $(function(){
    $('select[name=type_id]').change(function(){
      $('form[name=searchForm]').submit();
    });
    $('tr').addClass('success');
  });
</script>
  <form action="/index.php/Admin/Attribute/showlist/type_id/1/p/1.html" name="searchForm">
    <img src="/Public/Admin/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />  按商品类型显示：
    <select name="type_id">
        <option value="0">所有分类</option>
        <?php foreach($typelist as $v){ ?>
          <option value="<?php echo $v['type_id']?>" <?php if($type_id==$v['type_id']) echo "selected";?>><?php echo $v['type_name']?></option>
        <?php
 }?>
    </select>
  </form>
</div>
<form method="post" action="" name="listForm" >

  <div class="list-div table-responsive" id="listDiv">
    <table cellpadding="3" cellspacing="1" class="table table-striped table-hover table-condensed">
      <tr>
        <th>
          <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />
          <a href="#">编号</a><img src="/Public/Admin/images/sort_desc.gif"/>    </th>

        <th><a href="#">属性名称</a></th>
        <th><a href="#">商品类型</a></th>
        <th><a href="#">属性录入方式</a></th>
        <th><a href="#">可选值列表</a></th>
            <th>操作</th>
      </tr>
      <?php foreach($list as $rows){ ?>
        <tr>
        <td><input type="checkbox" name="checkboxes[]" value="<?php echo $rows['attr_id'];?>" /><?php echo $rows['attr_id'];?></td>

        <td class="first-cell" align="center"><span ><?php echo $rows['attr_name']?></span></td>
        <td align="center"><span><?php echo $rows['type_name']?></span></td>
        <td align="center"><span ><?php echo $rows['attr_input_type']==0?'手工录入':'从列表中选择' ?>
        </span></td>
        <td align="center"><?php echo $rows['attr_value']?></td>
            <td align="center">

          <a href="<?php echo U('update',array('attr_id'=>$rows['attr_id'],'p'=>$nowpage)) ?>" title="编辑"><img src="/Public/Admin/images/icon_edit.gif" width="16" height="16" border="0" /></a>

          <a href="javascript:;" onclick="if(confirm('确定删除吗'))location.href='<?php echo U('del',array('attr_id'=>$rows['attr_id'],'p'=>$nowpage,'type_id'=>$type_id))?>'"  title="回收站"><img src="/Public/Admin/images/icon_trash.gif" width="16" height="16" border="0" /></a>
              </td>
      </tr>
        <?php
 }?>
        <tr>
          <td colspan="6" align="center">
            <?php echo $pageinfo?>
          </td>
        </tr>
    </table>
</div>
</form>

<div id="footer">
共执行 7 个查询，用时 0.112141 秒，Gzip 已禁用，内存占用 3.085 MB<br />
版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>