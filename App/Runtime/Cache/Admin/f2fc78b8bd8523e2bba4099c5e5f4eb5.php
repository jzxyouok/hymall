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
          padding-top: 150px;    /*菜单固定在顶部，内容会钻到下面去，给body加内填充把内容挤下去*/
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
          <p class="navbar-text" >修改商品类型</p>
          <a href="/index.php/Admin/Type/showlist" class="btn btn-default navbar-btn navbar-right" style="margin-right:20px">商品类型列表</a>
          <p class="navbar-text pull-right">欢迎<a href="#" class="navbar-link">掌门人</a>登录</p>
        </div>
    </div>

    <div class="col-md-6 col-md-offset-3">
        <form action="/index.php/Admin/Type/update/type_id/8/p/1.html" method="post" class="form-horizontal">
            <!--单行文本域-->
              <div class="form-group has-success">
                <div class="col-md-4 text-right">
                  <label for="type_name" class="control-label">商品类别名称</label>
                </div>
                <div class="col-md-8">
                  <input type="text" value="<?php echo $info['type_name']?>" name="type_name" id="type_name" class="form-control"/>
                </div>
              </div>

              <input type="hidden" name='type_id' value="<?php echo $info['type_id']?>"/>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-5">
                  <input type="submit" value="修改" class="btn btn-primary "/>
                  <input type="reset" value="重置" class="btn btn-danger" />
                </div>
              </div>
        </form>
    </div>
    <div class="clearfix"></div>
    <div class="footer" style="margin-top:300px;background-color:#ccc">
      <p class="text-center">共执行 1 个查询，用时 0.015001 秒，Gzip 已禁用，内存占用 2.059 MB</p>
      <p class="text-center">
版权所有 © 2005-2012 上海商派网络科技有限公司，并保留所有权利。</p>
    </div>  
</div>
</body>
</html>