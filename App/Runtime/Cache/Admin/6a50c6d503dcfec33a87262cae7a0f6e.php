<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!--导入css和js插件-->
<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/holder.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/application.js"></script>
    <style type="text/css">
        body{
          background: #80BDCB;
        }
    </style>
  </head>
  <body>
    <div class="container">
      <div style="width: 160px;" class="text-center">
      <?php foreach ($list as $key=>$value) { ?>
          <a class="btn btn-info btn-block btn-lg" href="javascript:;" data-toggle="collapse" data-target="#collapseExample<?php echo $key?>">
          <?php echo $value['priv_name']?>
        </a>
        <div class="collapse" id="collapseExample<?php echo $key?>">
            <div class="list-group">
              <?php foreach($value['child'] as $v){ $url=$v['module_name'].'/'.$v['controller_name'].'/'.$v['action_name']; ?>
                <a href="<?php echo U($url)?>" target="main-frame" class="list-group-item"><?php echo $v['priv_name']?></a>
              <?php
 } ?>
            </div>
        </div>
      <?php
 } ?>
      
      </div>
    </div>
  </body>
</html>