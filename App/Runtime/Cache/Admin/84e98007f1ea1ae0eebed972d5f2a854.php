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
          <p class="navbar-text" >添加商品属性</p>
          <a href="/index.php/Admin/Attribute/showlist" class="btn btn-default navbar-btn navbar-right" style="margin-right:20px">商品属性</a>
          <p class="navbar-text pull-right">欢迎<a href="#" class="navbar-link">掌门人</a>登录</p>
        </div>
    </div>
        <h1 class="page-header text-center">添加商品属性</h1>
    <div class="col-md-8 col-md-offset-1">
        <form action="/index.php/Admin/Attribute/add.html" method="post" class="form-horizontal">
            <!--单行文本域-->
              <div class="form-group has-success">
                <div class="col-md-4 text-right">
                  <label for="attr_name" class="control-label">属性名称：</label>
                </div>
                <div class="col-md-8">
                  <input type="text" name="attr_name" id="attr_name" class="form-control"/>
                </div>
              </div>
            
              <!--下拉菜单-->
              <div class="form-group has-success">
                <div class="col-md-4 text-right">
                  <label for="type_id" class='control-label'>所属商品类型：</label>
                </div>
                <div class="col-md-8">
                  <select name="type_id" id="type_id" class="form-control">
                    <option value="0">---请选择---</option>
                    <?php foreach($list as $rows){ ?>
                      <option value="<?php echo $rows['type_id']?>"><?php echo $rows['type_name']?></option>
                    <?php
 } ?>
                  </select>
                </div>
              </div>
              
              <!--横向排列的单选按钮，竖向排列将radio-inline改成radio即可-->
              <div class="form-group has-success">
                <div class="col-md-4 text-right">
                  <label for="" class="control-label">属性是否可选</label>
                </div>
                <div class="col-md-8">
                  <div class="radio-inline">
                    <label>
                      <input type="radio" value="0" name="attr_type"  checked="checked"/>唯一属性
                    </label>
                  </div>
                  <div class="radio-inline">
                    <label>
                      <input type="radio" value="1" name="attr_type"  />单选属性
                    </label>
                  </div>
                </div>
              </div>

               <!--横向排列的单选按钮，竖向排列将radio-inline改成radio即可-->
              <div class="form-group has-success">
                <div class="col-md-4 text-right">
                  <label for="" class="control-label">该属性值的录入方式：</label>
                </div>
                <div class="col-md-8">
                  <div class="radio-inline">
                    <label>
                      <input type="radio" value="0" name="attr_input_type"  checked="checked"/>手工录入
                    </label>
                  </div>
                  <div class="radio-inline">
                    <label>
                      <input type="radio" value="1" name="attr_input_type"  />从下面的列表中选择（多个用逗号隔开）
                    </label>
                  </div>
                </div>
              </div>

              <!--多行文本域-->
              <div class="form-group has-success">
                <div class="col-md-4 text-right">
                  <label for="attr_value" class="control-label">可选值列表：</label>
                </div>
                <div class="col-md-8">
                  <textarea name="attr_value" id="attr_value" rows="5" 
                  class="form-control input-lg" ></textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-6">
                  <input type="submit" value="添加" class="btn btn-primary "/>
                  <input type="reset" value="重置" class="btn btn-danger" />
                </div>
              </div>
        </form>
    </div>
    <div class="clearfix"></div>
    <div class="footer" style="margin-top:20px;background-color:#ccc">
      <p class="text-center">共执行 1 个查询，用时 0.015001 秒，Gzip 已禁用，内存占用 2.059 MB</p>
      <p class="text-center">
版权所有 © 2005-2012 上海商派网络科技有限公司，并保留所有权利。</p>
    </div>  
</div>
</body>
</html>
<script type="text/javascript">
  //一刷新页面默认文本域禁止写入
  $('textarea[name=attr_value]').attr('disabled',true);
  //给属性录入方式radio增加点击事件
  $('input[name=attr_input_type]').click(function(){
    var value=$(this).val();
    if(value==1){
      $('textarea[name=attr_value]').attr('disabled',false);
    }else{
      $('textarea[name=attr_value]').val('').attr('disabled',true);
    }
  });

</script>