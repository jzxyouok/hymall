<?php 
	/*
	* 商品模型
	*/
namespace Model;
use Think\Model;
class GoodsModel extends Model{
	//_before_insert()函数在add方法时自动调用
	protected function _before_insert(&$data,$options){
		/*
		//执行上传文件（取出配置的允许上传的文件类型和保存根目录）
		$rootPath=C('UPLOAD_ROOT_PATH');
		$ext=C('UPLOAD_ALLOW_EXT');
		//取出php.ini里面允许上传单个文件的大小配置
		$upload_max_filesize=(int)ini_get('upload_max_filesize');
		//取出配置的上传文件的大小与php.ini中的比较取最小值
		$upload_file_size=(int)C('UPLOAD_FILE_SIZE');
		$upload_max_size=min($upload_max_filesize,C('upload_file_size'));
		//实例化上传对象
		$upload = new \Think\Upload();  
		$upload->maxSize   =   $upload_max_size*1024*1024;	//设置上传的文件大小（单位是字节）
		$upload->exts      =   $ext;	//设置上传的文件类型
		$upload->rootPath  =   $rootPath;	//设置上传文件根目录
		$upload->savePath  =   'Goods/';	//设置上传文件保存目录,相对于跟目录
		$info   =   $upload->upload();		//调用上传的方法，返回上传信息的二维数组
		
		if($info){		//上传成功
			//原图的路径
			$goods_ori=$info['goods_img']['savepath'].$info['goods_img']['savename'];
			//生成缩略图
			$image = new \Think\Image(); 
			$image->open($rootPath.$goods_ori);
			//缩略图的保存名
			$goods_img=$info['goods_img']['savepath'].'img_'.$info['goods_img']['savename'];		//中图名称
			$goods_thumb=$info['goods_img']['savepath'].'thumb_'.$info['goods_img']['savename'];	//小图名称
			//生成多张缩略图，大的放前面，不然需要多次打开原图
			$image->thumb(230, 230)->save($rootPath.$goods_img);
			$image->thumb(100, 100)->save($rootPath.$goods_thumb);
			//将三张图片的路径放入到数组中，键是数据表中的字段名
			$data['goods_ori']=$goods_ori;
			$data['goods_img']=$goods_img;
			$data['goods_thumb']=$goods_thumb;
		}
		else{
			$this->error=$upload->getError();	//将上传的错误直接赋予error属性，在控制器中可以获取
			return false;
		}
		*/
	
	//调用封装好的上传单个文件的方法
	if($_FILES['goods_img']['error']==0){
			$res=uploadOneImage('goods_img','Goods',array(array(100,100),array(230,230)));
			if($res['ok']==1){
				//上传成功
				$data['goods_ori']=$res['img'][0];			//原图路径加入添加数组中
				$data['goods_thumb']=$res['img'][1];		//小图路径加入添加数组中
				$data['goods_img']=$res['img'][2];			//中图路径加入添加数组中
			}else{
				//上传失败
				$this->error=$res['error'];
				return false;
			}
		}
		// 插入添加时间
		$data['add_time']=time();
		//如果没有添加货号，自动生成一个唯一货号
		if(!I('post.goods_sn')){
			$data['goods_sn']=uniqid();
		}	
	}

	//_after_insert()函数在add方法执行完毕后自动执行(商品属性的添加要在商品添加完紧跟)
	protected function _after_insert($data,$options){
		$goods_id=$data['goods_id'];
		$attr=I('post.attr');
		foreach ($attr as $key => $value) {
			if(is_array($value)){
				//是数组，代表添加的是单选属性，比如同一个商品好几个颜色
				foreach ($value as $v) {
					//实例化it_goods_attr对象(首字母大写，下划线去掉后面单词首字母也要大写)
					M('GoodsAttr')->add(array(
						'goods_id'=>$goods_id,
						'attr_value'=>$v,
						'attr_id'=>$key
					));
				}
			}else{
				//不是数组
					M('GoodsAttr')->add(array(
						'goods_id'=>$goods_id,
						'attr_value'=>$value,
						'attr_id'=>$key
					));
			}
		}

		//商品添加相册要在商品添加完成后紧跟进行
		if(hasImage('goods_photo')){
			$result=uploadMoreImages('goods_photo','Photo',array(array(150,150)));
			//相册入库
			if($result['ok']==1){
				//上传成功
				foreach ($result['img'] as  $value) {
					M('GoodsPhoto')->add(array(
						'goods_id'=>$goods_id,
						'photo_ori'=>$value[0],
						'photo_thumb'=>$value[1]
					));
				}
			}else{
				//上传失败
				$this->error=$result['error'];
				return false;
			}	
		}
		
	}

	//删除商品的属性和相册需要在删除商品前进行，要用到被删除的商品goods_id
	protected function _before_delete($options){
		$goods_id=$options['where']['goods_id'];
		//删除商品自身的图片
		$imgs=$this->field('goods_ori,goods_img,goods_thumb')->find($goods_id);	//一维数组
		//如果有图片就调用删除图片的方法
		if($imgs['goods_ori']){
			deleteImages($imgs);
		}
		//删除商品的属性
		M('GoodsAttr')->where("goods_id=$goods_id")->delete();
		//删除相册的图片
		$photoimgs=M('GoodsPhoto')->field('photo_ori,photo_thumb')->where("goods_id=$goods_id")->select();	//二维数组
		//如果有图片则遍历删除
		if($photoimgs){
			foreach ($photoimgs as $v) {
				deleteImages($v);
			}	
		}
		//删除相册表中的数据记录
		M('GoodsPhoto')->where("goods_id=$goods_id")->delete();		
	}

	//取出精新热商品，用于前台显示
	//第一个参数$type，表示获取商品的类型只接受new best hot 
	//第二个参数取几个商品
	public function getGoodsByType($type,$num){
		if($type=='hot' || $type=='new' || $type=='best'){
			return $this->field('goods_id,goods_name,goods_thumb,shop_price')->where('is_'.$type.'=1')->limit($num)->select();
		}
	}

	//取出设置库存的属性id和属性名及值
	public function getRadio($goods_id){
		$sql="select a.*,b.attr_name from it_goods_attr a left join it_attribute b using(attr_id)
		where goods_id=$goods_id and attr_id in(select attr_id from it_goods_attr where goods_id
		=$goods_id group by attr_id having count(*)>1)";
		return $this->query($sql);
	}
}