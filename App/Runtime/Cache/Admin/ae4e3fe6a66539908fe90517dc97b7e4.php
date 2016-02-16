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
          <p class="navbar-text" >新建角色</p>
          <a href="/index.php/Admin/Role/showlist" class="btn btn-default navbar-btn navbar-right" style="margin-right:20px">角色列表</a>
          <p class="navbar-text pull-right">欢迎<a href="#" class="navbar-link">掌门人</a>登录</p>
        </div>
    </div>

    <div class="panel panel-success">
       <div class="panel-heading"> <h1 class="page-header text-center">添加角色</h1></div>
      <div class="panel-body">
          <div class="col-md-6 col-md-offset-3">
            <form action="/index.php/Admin/Role/add.html" method="post" class="form-horizontal">
                <!--单行文本域-->
                  <div class="form-group has-success">
                    <div class="col-md-4 text-right">
                      <label for="role_name" class="control-label">角色名称</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" name="role_name" id="role_name" class="form-control"/>
                    </div>
                  </div>
            
                  <!--横向排列的复选框，竖向排列将checkbox-inline换成checkbox即可-->
                <div class="form-group has-success">
                  <div class="col-md-4 text-right">
                    <label for="" class="control-label">分配权限</label>
                  </div>
                  <div class="col-md-8">
                  <?php foreach ($priv_list as $v) { ?>
                    <div class="checkbox" style="margin-left:<?php echo $v['lev']*30?>px">
                      <label>
                        <input type="checkbox" value="<?php echo $v['priv_id']?>" name="priv[]" id="" /><?php echo $v['priv_name']?>
                      </label>
                    </div>
                  <?php
 }?> 
                  </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-5">
                      <input type="submit" value="添加" class="btn btn-primary "/>
                      <input type="reset" value="重置" class="btn btn-danger" />
                    </div>
                  </div>
            </form>
          </div>
      </div>
      <div class="panel-footer text-center">
        <p>共执行 1 个查询，用时 0.015001 秒，Gzip 已禁用，内存占用 2.059 MB</p>
      <p>版权所有 © 2005-2012 上海商派网络科技有限公司，并保留所有权利。</p>
      </div>
    </div>
</div>
</body>
</html>
<!-- 选中一个权限自动勾选其所有父级权限 -->
<script type="text/javascript">
  $(':checkbox').click(function(){
    var priv_id=$(this).val();
    $.get(
      '<?php echo U('Role/getParents')?>',
      {'priv_id':priv_id},
      function(data){
         $.each($(':checkbox'),function(index,value){
            for(s in data){
               if($(value).val()==data[s])
                this.checked=true;
            } 
         });
      }
    );
  });
</script>