<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <!--导入css和js插件-->
<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/holder.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/application.js"></script>
<style>
    body{
      background: #80BDCB;
    }
    #submenu{
      height: 50px;
    }
    #submenu li{
      background:transparent;
      float: right;
      border-right: 1px solid #278296;
      margin-bottom: 5px;
    }
    #submenu a{
      float: right;
      margin-right: 10px;
    }
    #logo{
      position: absolute;
      left: 20px;
      top:-10px;
    }
    #menu{
      height: 24px;
      padding-left: 30px;
      font-weight: bold;
    }
    #menu li{
      border-right: 1px solid #278296;
      width: 100px;
      text-align: center;
    }

</style>
</head>
<body>
    <div style="height:70px">
          <div id="submenu">
              <ul class='list-unstyled list-inline'>
                <li><a href="javascript:volid(0);" class='text-warning'>关于ecshop</a></li>
                <li><a href="javascript:volid(0);" class='text-warning'>帮助</a></li>
                <li><a href="javascript:volid(0);" class='text-warning'>计算器</a></li>
                <li><a href="javascript:volid(0);" class="text-warning">查看网站</a></li>
                <li><a href="javascript:volid(0);" class='text-warning'>管理员留言</a></li>
                <li><a href="javascript:volid(0);" class='text-warning'>个人设置</a></li>
                <li><a href="javascript:volid(0);" class='text-warning'>刷新</a></li>
                <li><a href="javascript:volid(0);" class="text-warning">记事本</a></li>
                <li><a href="javascript:volid(0);" class="text-warning">开店向导</a></li>
            </ul>
            <div class="clearfix"></div>
            <a href="<?php echo U('Login/logout')?>" class="btn btn-info btn-xs">退出</a>
            <a href="javascript:volid(0);" class="btn btn-info btn-xs">清除缓存</a>
            <div id="logo">
               <h1>掌门人.com</h1>
            </div>
          </div>

           <div id="menu">
              <ul class='list-unstyled list-inline'>
                <li><a href="javascript:volid(0);" class='text-success'>起始页</a></li>
                <li><a href="javascript:volid(0);" class='text-success'>设置导航栏</a></li>
                <li><a href="javascript:volid(0);" class='text-success'>商品列表</a></li>
                <li><a href="javascript:volid(0);" class="text-success">订单列表</a></li>
                <li><a href="javascript:volid(0);" class='text-success'>用户评论</a></li>
                <li><a href="javascript:volid(0);" class='text-success'>会员列表</a></li>
                <li><a href="javascript:volid(0);" class='text-success'>商店设置</a></li>
            </ul>
          </div>
    </div>
</body>
</html>