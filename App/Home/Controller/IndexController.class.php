<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends MyController {
    public function index(){
    	
    	//取出层级格式化过的栏目信息，用于前台左侧菜单栏显示
    	//每次都递归取出，服务器和数据库压力都很大，优化方法将数据缓存存入memcache中
    	S(array(
    	    'type'=>'memcache',			//初始化memcache服务
    	    'host'=>'localhost',    
    	    'port'=>'11211'));
    	//直接从缓存中取cat_list
    	$cat_list=S('catl_ist');
    	//如果为空，则去服务器将数据取出并加入到memcache缓存中
    	if(empty($cat_list)){
            $cat_model=new \Model\CategoryModel();
    		$cat_list=$cat_model->getTree();
    		S('cat_list',$cat_list,3600*24);
    	}
    	$this->assign('cat_list',$cat_list);

    	//在首页取出精品热卖新品商品
    	$goods_model=new \Model\GoodsModel();
    	// 这种写法不用assign直接属性赋值
    	$this->goods_hot_list=$goods_model->getGoodsByType('hot',3);
    	$this->goods_new_list=$goods_model->getGoodsByType('new',3);
    	$this->goods_best_list=$goods_model->getGoodsByType('best',3);

        $this->display();
    }

    //按栏目显示商品
    public function Category(){
    	$cat_model=new \Model\CategoryModel();
        $goods_model=new \Model\GoodsModel();
        //精品推荐
        $this->goods_best_list=$goods_model->getGoodsByType('best',3);

    	//判断栏目是否是顶级栏目,是就查出该栏目下所有子栏目的商品
    	$cat_id=$_GET['cat_id']+0;
    	$ids=$cat_model->getChild($cat_id);
    	if(empty($ids)){
    		//代表自身是子栏目,将自身加入到数组中
    		$ids[]=$cat_id;	
    	}
    	$ids=implode(',', $ids);
    	
    	//总记录数
    	$count=$goods_model->where("cat_id in ($ids)")->count();
        $pagesize=2; 
        //总页数
        $pagecount=ceil($count/$pagesize);
        //获取页码                             
        $pageno=isset($_GET['pageno'])?$_GET['pageno']:1;
        if($pageno<1){$pageno=1;}
        if($pageno>$pagecount){$pageno=$pagecount;}   

    	$goods_cat_list=$goods_model->field('goods_id,goods_name,shop_price,goods_thumb')
    	->where("cat_id in ($ids)")->page($pageno,$pagesize)->select();
        if(isset($_GET['pageno'])){
            $this->ajaxReturn($goods_cat_list);
            exit;
        }else{
            $this->assign('goods_cat_list',$goods_cat_list);
            $this->assign('pagecount',$pagecount);
            $this->assign('pageno',$pageno);
            $this->assign('cat_id',$cat_id);
            $this->display();
        }
    }

    //商品详情页面
    public function detail(){
    	$goods_id=$_GET['goods_id']+0;
    	$goods_model=new \Model\GoodsModel();
    	$goods_info=$goods_model->find($goods_id);
    	//如果没有商品则跳转到首页
    	if(empty($goods_info)){
    		header('location:/index.php');
    	}
        //取出商品属性
        $attrdata=M('GoodsAttr')->field("a.id,a.attr_id,a.attr_value,b.attr_type,b.attr_name")
        ->join("a left join it_attribute b using(attr_id)")->where("goods_id=$goods_id")->select();
        //重置数组，把单选属性过滤出来，方便遍历
        $radiodata=array();
        foreach ($attrdata as $v) {
            if($v['attr_type']==1){
                $radiodata[$v['attr_id']][]=$v;
            }
        }
        $this->assign('radiodata',$radiodata);
        //取出栏目家谱树，用做面包屑导航
        $cat_model=new \Model\CategoryModel();
        $cat_family=$cat_model->getFamily($goods_info['cat_id']);
        $this->assign('cat_family',$cat_family);
    	$this->assign('goods_info',$goods_info);
    	$this->display();
    }
}