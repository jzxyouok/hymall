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
            <p class="navbar-text" style="font-size:16px" >商品列表</p>
            
               <!--下拉菜单-->
            <div class="form-group has-success pull-left" style="width:300px;margin-top:8px">
                <div class="col-md-8">
                  <select name="cat_id" id="cat_id" class="form-control">
                    <option value="0">请选择分类...</option>
                    <?php foreach($cat_list as $rows){ ?>
                      <option value="<?php echo $rows['cat_id']?>"><?php echo str_repeat('&nbsp;', $rows['lev']*3).$rows['cat_name']?></option>
                    <?php
 } ?>
                  </select>
                </div>
            </div>
              <!--导航栏中表单元素-->
            <form action="" class="navbar-form pull-right">
              <div class="input-group" style="width:200px">
                <input type="text" name="keywords" id="keywords" placeholder="请输入关键字..." class="form-control" />
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-success btn-block" style="margin-top:0px;height:34px;width:40px"><span class="glyphicon glyphicon-search"></span></button>
                </span>
              </div>
            </form>

            <a href="/index.php/Admin/Goods/add" class="btn btn-default navbar-btn pull-right">添加商品</a>
            <p class="navbar-text pull-right" style="font-size:16px">欢迎<a href="#" class="navbar-link">掌门人</a>登录</p>
        </div>
</div>
<form method="post" action="" name="listForm" >

  <div class="list-div table-responsive" id="listDiv">
<table class="table table-striped table-hover table-condensed text-center" id="list-table">
  <tr>
    <th>
      <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />
      <a href="#">编号</a><img src="/Public/Admin/images/sort_desc.gif"/>    </th>

    <th><a href="#">商品名称</a></th>
    <th><a href="#">货号</a></th>
    <th><a href="#">价格</a></th>
    <th><a href="#">上架</a></th>
    <th><a href="#">精品</a></th>
    <th><a href="#">新品</a></th>

    <th><a href="#">热销</a></th>
    <th><a href="#">推荐排序</a></th>
        <th><a href="#">库存</a></th>
        <th>操作</th>
  </tr>
  <?php foreach ($goods_list as $rows) { ?>
          <tr>
        <td><input type="checkbox" name="checkboxes[]" value="<?php echo $rows['goods_id']?>" /><?php echo $rows['goods_id']?></td>

        <td class="first-cell" style=""><span ><?php echo $rows['goods_name']?></span></td>
        <td><span ><?php echo $rows['goods_sn']?></span></td>
        <td><span ><?php echo $rows['shop_price']?>
        </span></td>
        <td><img src="/Public/Admin/images/<?php echo $rows['is_sale']==1?'yes':'no'?>.gif"  /></td>
        <td><img src="/Public/Admin/images/<?php echo $rows['is_best']==1?'yes':'no'?>.gif"  /></td>
        <td><img src="/Public/Admin/images/<?php echo $rows['is_new']==1?'yes':'no'?>.gif"  /></td>
        <td><img src="/Public/Admin/images/<?php echo $rows['is_hot']==1?'yes':'no'?>.gif"  /></td>

        <td><span >100</span></td>
            <td><span ><?php echo $rows['goods_number']?></span></td>
            <td>
          <a href="#" target="_blank" title="查看"><img src="/Public/Admin/images/icon_view.gif" width="16" height="16" border="0" /></a>
          <a href="#" title="编辑"><img src="/Public/Admin/images/icon_edit.gif" width="16" height="16" border="0" /></a>
          <a href="#" title="复制"><img src="/Public/Admin/images/icon_copy.gif" width="16" height="16" border="0" /></a>
          <a href="<?php echo U('del',array('goods_id'=>$rows['goods_id'],'p'=>$nowpage))?>"  title="回收站" onclick="return confirm('确定删除吗')"><img src="/Public/Admin/images/icon_trash.gif" width="16" height="16" border="0" /></a>
          <a href="<?php echo U('product',array('goods_id'=>$rows['goods_id'],'p'=>$nowpage))?>" title="货品列表"><img src="/Public/Admin/images/icon_docs.gif" width="16" height="16" border="0" /></a>         
         </td>
  </tr>
    <?php
 }?>
  <tr><td colspan="11"><?php echo $pageinfo?></td></tr>
</table>

</div>
</form>

<div id="footer">
共执行 7 个查询，用时 0.112141 秒，Gzip 已禁用，内存占用 3.085 MB<br />
版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>
<script type="text/javascript">
  $('tr').addClass('success');
</script>