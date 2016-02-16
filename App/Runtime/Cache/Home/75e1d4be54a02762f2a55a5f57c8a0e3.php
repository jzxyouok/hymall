<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="Generator" content="YONGDA v1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="" />
        <meta name="Description" content="" />

        <title>购物流程_YONGDA商城 - Powered by YongDa</title>

        <link href="/Public/Home/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
        <style type="text/css">
            table {border:1px solid #dddddd; border-collapse: collapse; width:99%; margin:auto;}
            td {border:1px solid #dddddd;}
            #consignee_addr {width:450px;}
        </style>
    </head>
    <body>
    
        <div class="block clearfix" style="position: relative; height: 98px;">
            <a href="#" name="top"><img class="logo" src="/Public/Home/images/logo.gif"></a>

            <div id="topNav" class="clearfix">
                <div style="float: left;"> 
                    <font id="ECS_MEMBERZONE">
                        <div id="append_parent"></div>
                        欢迎光临本店&nbsp;
                        <?php if($_SESSION['user_id']){ ?>
                            <?php echo $_SESSION['username']?>
                            <a href="<?php echo U('User/logout')?>">退出</a>
                        <?php
 }else{ ?>
                            <a href="<?php echo U('User/login')?>"> 登录</a>
                            <a href="<?php echo U('User/register')?>">注册</a>
                        <?php
 } ?>
                        
                    </font>
                </div>
                <div style="float: right;">
                    <a href="#">查看购物车</a>
                    |
                    <a href="#">选购中心</a>
                    |
                    <a href="#">标签云</a>
                    |
                    <a href="#">报价单</a>
                </div>
            </div>
            <div id="mainNav" class="clearfix">
                <a href="/index.php" class="cur">首页<span></span></a>
                <?php foreach ($nav_list as $v) { ?>
                    <a href="<?php echo U('Index/category',array('cat_id'=>$v['cat_id']))?>"><?php echo $v['cat_name']?><span></span></a>
                <?php
 }?>       
            </div>
        </div>

        <div class="header_bg">
            <div style="float: left; font-size: 14px; color:white; padding-left: 15px;">
            </div>  

            <form id="searchForm" method="get" action="#">
                <input name="keywords" id="keyword" type="text" />
                <input name="imageField" value=" " class="go" style="cursor: pointer; background: url('/Public/Home/images/sousuo.gif') no-repeat scroll 0% 0% transparent; width: 39px; height: 20px; border: medium none; float: left; margin-right: 15px; vertical-align: middle;" type="submit" />

            </form>
        </div>
        <div class="blank5"></div>
        <div class="header_bg_b">
            <div class="f_l" style="padding-left: 10px;">
                <img src="/Public/Home/images/biao6.gif" />
                    北京市区，现在下单(截至次日00:30已出库)，<b>明天上午(9-14点)</b>送达 <b>免运费火热进行中！</b>
            </div>
            <div class="f_r" style="padding-right: 10px;">
                <img style="vertical-align: middle;" src="/Public/Home/images/biao3.gif">
                    <span class="cart" id="ECS_CARTINFO">
                        <a href="#" title="查看购物车">您的购物车中有 <span id="total_count"><?php echo $total['total_count']?></span> 件商品，总计金额 ￥<span id="top_total_price"><?php echo $total['total_price']?></span>元。</a></span>
                    <a href="<?php echo U('Cart/cartlist')?>"><img style="vertical-align: middle;" src="/Public/Home/images/biao7.gif"></a>

            </div>
        </div>

        <div class="block box">
            <div class="blank"></div>
            <div id="ur_here">
                当前位置: <a href="#">首页</a> <code>&gt;</code> 购物流程 
            </div>
        </div>
        <div class="blank"></div>

        <div class="blank"></div>
        <div class="block">
            <div class="flowBox">
                <h6><span>商品列表</span></h6>
                <form id="formCart">
                    <table cellpadding="5" cellspacing="1" id="cartlist">
                        <tbody><tr>
                                <th>商品名称</th>
                                <th>属性</th>
                                <th>市场价</th>
                                <th>本店价</th>
                                <th>购买数量</th>
                                <th>小计</th>
                                <th>操作</th>
                            </tr>


<script type="text/javascript">
    $(function(){
        $('#cartlist a').click(function(){
            attr=$(this).attr('class');
            //计算商品单价
           var danjia=parseFloat($(this).parent().parent().find('span:first').html());
           //找出原来的购买数量
           var goods_count=parseInt($(this).parent().parent().find('input[name=goods_count]').val());
           //找出原来的小计价格
           var xiaoji_price=parseFloat($(this).parent().parent().find('span:last').html());
            //原来的总价格
           var total_price=parseFloat($('#total_price').html());
            //原来的头部商品总件数
           var total_count=parseInt($('#total_count').html());
           //获取商品的id和属性表的id(隐藏域)
           var goods_id=$(this).parent().find('input[name=goods_id]').val();
           var goods_attr_id=$(this).parent().find('input[name=goods_attr_id]').val();
            if(attr=='decr'){
                //新的购买数量等于原来的+1
               var new_goods_count=goods_count-1;
               //新的小计价格
               var new_xiaoji_price=xiaoji_price-danjia;
                //新的头部商品总件数
               var new_total_count=total_count-1;
               //新的总价格
               var new_total_price=total_price-danjia;
              //新的市场总价格
               var new_market_total_price=Math.round(new_total_price*1.2);

            }else{
               //新的购买数量等于原来的+1
               var new_goods_count=goods_count+1;
               //新的小计价格
               var new_xiaoji_price=xiaoji_price+danjia;
              //新的头部商品总件数
               var new_total_count=total_count+1;
              //新的总价格
               var new_total_price=total_price+danjia;
              //新的市场总价格
               var new_market_total_price=Math.round(new_total_price*1.2);

            }
            _this=$(this);      //将当前的jquery对象（a标签）保存在一个变量中，方便方法中使用
            $.get(
                '/index.php/Home/Cart/updateCart',
                {'goods_id':goods_id,'goods_attr_id':goods_attr_id,'goods_count':(_this.attr('class')=='decr'?(-1):(+1))},
                function(data){
                    //成功，把新值赋予页面中
                        _this.parent().parent().find('input[name=goods_count]').val(new_goods_count);
                        _this.parent().parent().find('span:last').html(new_xiaoji_price);
                        //下面的总价格变动
                        $('#total_price').html(new_total_price);
                        //头部的总价格变动
                        $('#top_total_price').html(new_total_price);
                        //头部商品总数量的变动
                        $('#total_count').html(new_total_count);
                        $('#market_total_price').html(new_market_total_price);
                }
            );
        });
    })
 </script>
<?php foreach ($list as $key => $value) { ?>
     <tr>
        <td align="center">
            <a href="<?php echo U('Index/detail',array('goods_id'=>$value['goods_id']))?>" target="_blank"><img style="width: 80px; height: 80px;" src="<?php echo C('IMG_SRC').$value['info']['goods_thumb']?>" title="P806" /></a><br />
            <a href="<?php echo U('Index/detail',array('goods_id'=>$value['goods_id']))?>" target="_blank" class="f6"><?php echo $value['info']['goods_name']?></a>
        </td>
        <td><?php echo $value['attrs']?> <br />
        </td>
        <td align="right">￥<?php echo $value['info']['shop_price']*1.2?>元</td>
        <td align="right">￥<span><?php echo $value['info']['shop_price']?></span>元</td>
        <td align="right">
            <a href="javascript:;" class="decr"><img src="/Public/Home/images/menu_minus.gif"></a>
                <input name="goods_count" id="goods_number_43" value="<?php echo $value['goods_count']?>" size="4" class="inputBg" style="text-align: center;" onkeydown="showdiv(this)" type="text" />
            <a href="javascript:;" class="incr"><img src="/Public/Home/images/menu_plus.gif"></a>
            <input type="hidden" name="goods_id" value="<?php echo $value['goods_id']?>" />
            <input type="hidden" name="goods_attr_id" value="<?php echo $value['goods_attr_id']?>" />
        </td>
        <td align="right">￥<span><?php echo $value['goods_count']*$value['info']['shop_price']?></span>元</td>
        <td align="center">
            <a href="/index.php/Home/Cart/delCart/goods_id/<?php echo $value['goods_id']?>/goods_attr_id/<?php echo $value['goods_attr_id']?>" onclick="return confirm('确定删除吗')" class="f6">删除</a>
        </td>
    </tr>
<?php
}?>
                           
                        </tbody></table>
                    <table cellpadding="5" cellspacing="1">
                        <tbody><tr>
                                <td>
                                    购物金额小计 ￥<span id="total_price"><?php echo $total['total_price']?></span>元，比市场价 ￥<span id='market_total_price'><?php echo $total['total_price']*1.2?></span>元 节省了 ￥<?php echo $total['total_price']*0.2?>元 (17%)              </td>
                                <td align="right">
                                    <input value="清空购物车" class="bnt_blue_1"  type="button" <?php echo $total['total_count']>0?'':'disabled'?> onclick="location.href='<?php echo U('Cart/clearCart')?>'" />
                                    <input name="submit" class="bnt_blue_1" value="更新购物车" type="submit" />
                                </td>
                            </tr>
                        </tbody></table>
                    <input name="step" value="update_cart" type="hidden" />
                </form>
                <table cellpadding="5" cellspacing="0" width="99%">
                    <tbody><tr>
                            <td><a href="/index.php"><img src="/Public/Home/images/continue.gif" alt="continue" /></a></td>
                            <td align="right"><a href="<?php echo U('Order/checkout')?>"><img src="/Public/Home/images/checkout.gif" alt="checkout" /></a></td>
                        </tr>
                    </tbody></table>
            </div>
            <div class="blank"></div>
            <div class="blank5"></div>
        </div>

        <div class="blank"></div>
        <div class="block">

            <a href="#" target="_blank" title="YONGDA商城"><img alt="YONGDA商城" src="/Public/Home/images/di.jpg" /></a>

            <div class="blank"></div>
        </div>

        <div class="block">
            <div class="box">
                <div class="helpTitBg" style="clear: both;">
                    <dl>
                        <dt><a href="#" title="新手上路 ">新手上路 </a></dt>
                        <dd><a href="#" title="售后流程">售后流程</a></dd>
                        <dd><a href="#" title="购物流程">购物流程</a></dd>
                        <dd><a href="#" title="订购方式">订购方式</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="手机常识 ">手机常识 </a></dt>
                        <dd><a href="#" title="如何分辨原装电池">如何分辨原装电池</a></dd>
                        <dd><a href="#" title="如何分辨水货手机 ">如何分辨水货手机</a></dd>
                        <dd><a href="#" title="如何享受全国联保">如何享受全国联保</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="配送与支付 ">配送与支付 </a></dt>
                        <dd><a href="#" title="货到付款区域">货到付款区域</a></dd>
                        <dd><a href="#" title="配送支付智能查询 ">配送支付智能查询</a></dd>
                        <dd><a href="#" title="支付方式说明">支付方式说明</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="会员中心">会员中心</a></dt>
                        <dd><a href="#" title="资金管理">资金管理</a></dd>
                        <dd><a href="#" title="我的收藏">我的收藏</a></dd>
                        <dd><a href="#" title="我的订单">我的订单</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="服务保证 ">服务保证 </a></dt>
                        <dd><a href="#" title="退换货原则">退换货原则</a></dd>
                        <dd><a href="#" title="售后服务保证 ">售后服务保证</a></dd>
                        <dd><a href="#" title="产品质量保证 ">产品质量保证</a></dd>
                    </dl>
                    <dl>
                        <dt><a href="#" title="联系我们 ">联系我们 </a></dt>
                        <dd><a href="#" title="网站故障报告">网站故障报告</a></dd>
                        <dd><a href="#" title="选机咨询 ">选机咨询</a></dd>
                        <dd><a href="#" title="投诉与建议 ">投诉与建议</a></dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="blank"></div>

        <div id="bottomNav" class="box block">
            <div class="box_1">
                <div class="links clearfix"> 
                    <a href="#" target="_blank" title="YONGDA商城"><img src="/Public/Home/images/flow.htm" alt="YONGDA商城" /></a>


                    [<a href="#" target="_blank" title="">yongda商城</a>]
                </div>
            </div>
        </div>

        <div class="blank"></div>


        <div id="bottomNav" class="box block">
            <div class="bNavList clearfix">
                <a href="#">免责条款</a>
                |
                <a href="#">隐私保护</a>
                |
                <a href="#">Powered&nbsp;by&nbsp;<strong><span style="color: rgb(51, 102, 255);">YongDa</span></strong></a>
                |
                <a href="#">联系我们</a>
                |
                <a href="#">公司简介</a>
                |
                <a href="#">批发方案</a>
                |
                <a href="#">配送方式</a>

            </div>
        </div>



        <div id="footer">
            <div class="text">
                © 2005-2012 YONGDA 版权所有，并保留所有权利。<br />
            </div>
        </div>
    </body>
</html>