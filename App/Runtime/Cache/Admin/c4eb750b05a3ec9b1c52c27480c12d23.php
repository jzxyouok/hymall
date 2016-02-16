<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: goods_info.htm 17126 2010-04-23 10:30:26Z liuhui $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加新商品 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css" />
<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/holder.min.js"></script>
<script type="text/javascript" src="/Public/bootstrap/js/application.js"></script>
<script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
<style>
    body{
      padding-top: 60px;    /*菜单固定在顶部，内容会钻到下面去，给body加内填充把内容挤下去*/
    }
    #general,#detail,#mix,#attr{
      margin-top: 20px;
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
          <p class="navbar-text" style="font-size:17px" >新建商品</p>
          <a href="/index.php/Admin/Goods/showlist" class="btn btn-default navbar-btn navbar-right" style="margin-right:20px">商品列表</a>
          <p class="navbar-text pull-right" style="font-size:17px">欢迎<a href="#" class="navbar-link">掌门人</a>登录</p>
        </div>
</div>
<script type="text/javascript">
  $(function(){
    $('#detail,#mix,#attr,#photo').css('display','none');
    $('#mytab li a').click(function(){
      var id=$(this).attr('data-target');
      $('#general,#detail,#mix,#attr,#photo').css('display','none');
      $(id).css('display','block');
    });
  });
</script>

 <!-- 表单开始 -->
      <form enctype="multipart/form-data" action="/index.php/Admin/Goods/add.html" method="post" name="theForm" class="form-horizontal" >

<!-- 选项卡开始-->
  <div style="width:80%;" class="center-block">
            <!--选项-->
            <ul class="nav nav-tabs nav-justified" id="mytab">
              <li class="active"><a href="" data-toggle="tab" data-target="#general">通用信息</a></li>
              <li><a href="" data-toggle="tab" data-target="#detail">详细描述</a></li>
              <li><a href="" data-toggle="tab" data-target="#mix">其他信息</a></li>
              <li><a href="" data-toggle="tab" data-target="#attr">商品属性</a></li>
              <li><a href="" data-toggle="tab" data-target="#photo">商品相册</a></li>
            </ul>
   <!--选项内容开始-->
  <div class="tab-content">
     
<!-- 通用信息开始 -->
    <div class="tab-pane active fade in" id="general">
        <!--单行文本域-->
      <div class="form-group has-success">
        <div class="col-md-2 col-md-offset-3 text-right">
          <label for="goods_name" class="control-label">商品名称：</label>
        </div>
        <div class="col-md-4">
          <input type="text" name="goods_name" id="goods_name" class="form-control"/>
        </div>
      </div>

        <!--单行文本域-->
      <div class="form-group has-success">
        <div class="col-md-2 col-md-offset-3 text-right">
          <label for="goods_sn" class="control-label">商品货号：</label>
        </div>
        <div class="col-md-4">
          <input type="text" name="goods_sn" id="goods_sn" class="form-control"/>
          <p class="help-block">如果您不输入商品货号，系统将自动生成一个唯一的货号。</p>
        </div>
      </div>
        
        <!--下拉菜单-->
      <div class="form-group has-success">
        <div class="col-md-2 col-md-offset-3 text-right">
          <label for="cat_id" class='control-label'>商品分类：</label>
        </div>
        <div class="col-md-4">
          <select name="cat_id" id="cat_id" class="form-control">
            <option value="0">---请选择---</option>
            <?php foreach($cat_list as $rows){ ?>
              <option value="<?php echo $rows['cat_id']?>"><?php echo str_repeat('&nbsp;', $rows['lev']*3).$rows['cat_name']?></option>
            <?php
 } ?>
          </select>
        </div>
      </div>
          
          <!--单行文本域-->
      <div class="form-group has-success">
        <div class="col-md-2 col-md-offset-3 text-right">
          <label for="shop_price" class="control-label">本店售价：</label>
        </div>
        <div class="col-md-4">
          <input type="text" name="shop_price" id="shop_price" class="form-control"/>
        </div>
      </div> 

           <!--单行文本域-->
      <div class="form-group has-success">
        <div class="col-md-2 col-md-offset-3 text-right">
          <label for="market_price" class="control-label">市场售价：</label>
        </div>
        <div class="col-md-4">
          <input type="text" name="market_price" id="market_price" class="form-control"/>
        </div>
      </div>    
      
      <!--文件上传域-->
    <div class="form-group has-success">
      <div class="col-md-2 col-md-offset-3 text-right">
        <label for="goods_img" class="control-label">上传商品图片：</label>
      </div>
      <div class="col-md-4">
        <input type="file" name="goods_img" id="goods_img" class="btn btn-success" />
        <p class="help-block">点击此处上传文件（帮助）</p>
      </div>
    </div>    
            
  </div>
  <!-- 通用信息结束 -->
   <!--详细描述开始-->
<div class="tab-pane fade" id="detail">

    <!--多行文本域-->

  <div class="form-group has-success">
    <div class="col-md-12 col-md-offset-1">
      <textarea name="goods_desc" id="goods_desc"></textarea>
    </div>
  </div>

</div>
     <!--详细描述结束-->
        <!-- 其他信息开始 -->
        <div class="tab-pane fade" id="mix">
                 <!--单行文本域-->
                  <div class="form-group has-success">
                    <div class="col-md-2 col-md-offset-3 text-right">
                      <label for="goods_number" class="control-label">商品库存数量：</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" name="goods_number" id="goods_number" class="form-control"/>
                    </div>
                  </div>

                  <!--横向排列的单选按钮，竖向排列将radio-inline改成radio即可-->
                  <div class="form-group has-success">
                    <div class="col-md-2 col-md-offset-3 text-right">
                      <label for="" class="control-label">加入推荐：</label>
                    </div>
                    <div class="col-md-4">

                        <div class="checkbox-inline">
                          <label>
                            <input type="checkbox" value="1" name="is_best" />精品
                          </label>
                        </div>

                        <div class="checkbox-inline">
                          <label>
                            <input type="checkbox" value="1" name="is_new"  />新品
                          </label>
                        </div>

                        <div class="checkbox-inline">
                          <label>
                            <input type="checkbox" value="1" name="is_hot"  />热销
                          </label>
                        </div>

                    </div>
                  </div>

                  <div class="form-group has-success">
                    <div class="col-md-2 col-md-offset-3 text-right">
                      <label for="" class="control-label">上架：</label>
                    </div>
                    <div class="col-md-4">
                      <div class="checkbox-inline">
                        <label>
                          <input type="checkbox" value="1" name="is_sale" /> 打勾表示允许销售，否则不允许销售。
                        </label>
                      </div>
                    </div>
                  </div>      
        </div>
        <!-- 其他信息结束 -->
        <!-- 商品所属类型开始 -->
        <div class="tab-pane fade" id="attr">
                <!--下拉菜单-->
            <div class="form-group has-success">
              <div class="col-md-2 col-md-offset-3 text-right">
                <label for="type_id" class='control-label'>商品类型：</label>
              </div>
              <div class="col-md-4">
                <select name="type_id" id="type_id" class="form-control">
                  <option value="0">---请选择商品类型---</option>
                  <?php foreach($type_list as $rows){ ?>
                    <option value="<?php echo $rows['type_id']?>"><?php echo$rows['type_name']?></option>
                  <?php
 } ?>
                </select>
              </div>
            </div>
            <div class="row">
                  <div class="col-md-12" id="showAttr">
                    
                  </div>
            </div>
        </div> 
        <!-- 商品所属类型结束 -->
        <!-- ajax实现异步加载属性表单 -->
          <script type="text/javascript">
              $(function(){
                  $('select[name=type_id]').change(function(){
                    var type_id=$(this).val();
                    $.get(
                        '/index.php/Admin/Goods/showAttr',
                        {'type_id':type_id},
                        function(data){
                          $('#showAttr').html(data);
                        }
                      );
                  });
              });
          </script>

        <!--商品相册开始-->
          <div class="tab-pane fade" id="photo">

          <!--文件上传域-->

            <div class="form-group has-success">
                <div class="col-md-2 col-md-offset-3 text-right">
                  <label for="" class="control-label"><a href="javascript:;" onclick="copyphoto(this)"><span class="glyphicon glyphicon-plus"></span></a>上传商品相册：</label>
                </div>
                <div class="col-md-4">
                  <input type="file" name="goods_photo[]" id="" class="btn btn-info" />
                  <p class="help-block">点击此处上传文件（帮助）</p>
                </div>
            </div> 
            <!-- 实现点击+号自我复制 -->
            <script type="text/javascript">
                function copyphoto(o){
                  //获取当前表单组的div
                  var dives=$(o).parent().parent().parent();
                  //判断a标签的内容是否为+
                  if($(o).html()=='<span class="glyphicon glyphicon-plus"></span>'){
                      //是+号实现点击自我复制
                      new_dives=dives.clone();
                      //将新的dives中a标签的内容+换成-号
                      new_dives.find('a').html('<span class="glyphicon glyphicon-minus"></span>');
                      //将新的dives放在当前div后面
                      dives.after(new_dives);
                  }else{
                      //是-号实现移除当前div
                      dives.remove();
                  }
                }
            </script>
          </div>
     <!--商品相册结束-->
  </div>
<!--选项内容结束-->
  </div>
<!-- 选项卡结束-->
<!-- 按钮开始 -->
    <div class="form-group">
        <div class="col-md-2 col-md-offset-5">
          <input type="submit" value="添加" class="btn btn-primary "/>
          <input type="reset" value="重置" class="btn btn-danger" />
        </div>
    </div> 
<!-- 按钮结束-->
  </form>
<!-- 表单结束 -->

</body>
</html>
<!-- 引入在线编辑器 -->
<script>
  UE.getEditor('goods_desc',{
      'initialFrameWidth':'80%',
      'initialFrameHeight':200,
    }
  );
</script>