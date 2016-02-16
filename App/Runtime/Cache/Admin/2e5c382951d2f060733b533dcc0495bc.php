<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/bootstrap/js/holder.min.js"></script>
    <script type="text/javascript" src="/Public/bootstrap/js/application.js"></script>
    <style>
        body{
          padding-top: 30px;    /*菜单固定在顶部，内容会钻到下面去，给body加内填充把内容挤下去*/
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
<div class="container">
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
          <p class="navbar-text" >修改权限</p>
          <a href="/index.php/Admin/Privilege/showlist" class="btn btn-default navbar-btn navbar-right" style="margin-right:20px">权限列表</a>
          <p class="navbar-text pull-right" style="font-size:18px">欢迎<a href="#" class="navbar-link"><?php echo $_SESSION['admin_name']?></a>登录</p>
        </div>
    </div>
      
      <h1 class="page-header text-center">修改权限</h1>

    <div class="col-md-6 col-md-offset-3">
        <form action="/index.php/Admin/Privilege/update/priv_id/35.html" method="post" class="form-horizontal">
            <!--单行文本域-->
              <div class="form-group has-success">
                <div class="col-md-4 text-right">
                  <label for="priv_name" class="control-label">权限名称</label>
                </div>
                <div class="col-md-8">
                  <input type="text" name="priv_name" value="<?php echo $info['priv_name']?>" id="priv_name" class="form-control"/>
                </div>
              </div>

                  <!--下拉菜单-->
              <div class="form-group has-success">
                <div class="col-md-4 text-right">
                  <label for="parent_id" class='control-label'>上级权限</label>
                </div>
                <div class="col-md-8">
                  <select name="parent_id" id="parent_id" class="form-control">
                    <option value="0">顶级权限</option>
                    <?php foreach($priv_list as $rows){ if(in_array($rows['priv_id'], $ids)) continue; ?>
                      <option value="<?php echo $rows['priv_id']?>" <?php if($rows['priv_id']==$info['parent_id']) echo 'selected'?>><?php echo str_repeat('&nbsp;', $rows['lev']*6), $rows['priv_name']?></option>
                    <?php
 } ?>
                  </select>
                </div>
              </div>
              
               <!--单行文本域-->
              <div class="form-group has-success">
                <div class="col-md-4 text-right">
                  <label for="module_name" class="control-label">模块名称</label>
                </div>
                <div class="col-md-8">
                  <input type="text" name="module_name" value="<?php echo $info['module_name']?>" id="module_name" class="form-control"/>
                </div>
              </div>

               <!--单行文本域-->
              <div class="form-group has-success">
                <div class="col-md-4 text-right">
                  <label for="controller_name" class="control-label">控制器名称</label>
                </div>
                <div class="col-md-8">
                  <input type="text" name="controller_name" value="<?php echo $info['controller_name']?>" id="controller_name" class="form-control"/>
                </div>
              </div>

                <!--单行文本域-->
              <div class="form-group has-success">
                <div class="col-md-4 text-right">
                  <label for="action_name" class="control-label">方法名称</label>
                </div>
                <div class="col-md-8">
                  <input type="text" name="action_name" value="<?php echo $info['action_name']?>" id="action_name" class="form-control"/>
                </div>
              </div>

              <input type="hidden" name='priv_id' value="<?php echo $info['priv_id']?>"/>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-5">
                  <input type="submit" value="修改" class="btn btn-primary "/>
                  <input type="reset" value="重置" class="btn btn-danger" />
                </div>
              </div>
        </form>
    </div>
    <div class="clearfix"></div>
    <div class="footer" style="margin-top:200px;background-color:#ccc">
      <p class="text-center">共执行 1 个查询，用时 0.015001 秒，Gzip 已禁用，内存占用 2.059 MB</p>
      <p class="text-center">
版权所有 © 2005-2012 上海商派网络科技有限公司，并保留所有权利。</p>
    </div>  
</div>
</body>
</html>