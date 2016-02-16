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
<form method="post" action="/index.php/Admin/Goods/product/goods_id/6/p/1.html" name="listForm" >

  <div class="list-div table-responsive" id="listDiv">
<table class="table table-striped table-hover table-condensed text-center" id="list-table">
  <caption><code>商品名称：<?php echo $goods_info['goods_name']?></code></caption>
  <tr>
    
        <?php foreach ($radiodata as $k => $v) { ?>
        <th><?php echo $v[0]['attr_name']?></th>
        <?php
 }?>
        <th><a href="#">库存</a></th>
        <th>操作</th>
  </tr>
<?php if(!empty($kcdata)){ foreach ($kcdata as $key => $value) { ?>
      <tr>
      <?php foreach ($radiodata as $k => $v) { ?>
          <td>
            <select name="attr[<?php echo $k?>][]">
                <option>--请选择--</option>
                <?php foreach ($v as $k1 => $v1) { ?>
                <option value="<?php echo $v1['id']?>" <?php if(strpos(','.$value['goods_attr_id'].',', ','.$v1['id'].',')!==false) echo "selected"?>><?php echo $v1['attr_value']?></option>
                <?php
 }?>
            </select>
          </td>
      <?php
 }?>
      <td><input type="text" name="goods_number[]" value="<?php echo $value['goods_number']?>"/></td>
      <td><button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button></td>
    </tr>
    <?php
 } }else{ ?>
    <tr>
    <?php foreach ($radiodata as $k => $v) { ?>
        <td>
          <select name="attr[<?php echo $k?>][]">
              <option>--请选择--</option>
              <?php foreach ($v as $k1 => $v1) { ?>
              <option value="<?php echo $v1['id']?>"><?php echo $v1['attr_value']?></option>
              <?php
 }?>
          </select>
        </td>
    <?php
 }?>
    <td><input type="text" name="goods_number[]" value="<?php echo $value['goods_number']?>"/></td>
    <td><button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button></td>
  </tr>
<?php
}?>

  <input type="hidden" name="goods_id" value="<?php echo $goods_id?>" />
  <tr><td colspan="<?php echo count($radiodata)+2?>"><input type="submit" value="保存" class="btn btn-success btn-sm" /></td></tr>
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
  $('button').click(function(){
    //取出当前行
    var trs=$(this).parent().parent();
    //判断button中是否是+号
    if($(this).html()=='<span class="glyphicon glyphicon-plus"></span>'){
      //复制当前行
      new_trs=trs.clone(true);
      //将新行中的+换成-
      new_trs.find('button').html('<span class="glyphicon glyphicon-minus"></span>');
      //将新行放在当前行前面
      trs.before(new_trs);
    }else{
      //移除当前行
      trs.remove();
    }
  });
</script>