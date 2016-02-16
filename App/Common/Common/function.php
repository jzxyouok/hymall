<?php 
/*
* 定义一个过滤xss攻击的方法
*/
function removeXss($val){
    static $obj=null;
    if($obj===null){
        require './HTMLPurifier/HTMLPurifier.includes.php';
        $obj  = new HTMLPurifier();
    }
    return $obj->purify($val);
}

//定义一个打印数组的方法
function p($val){
	echo '<pre>';
	print_r($val);
}

/*
* 定义一个上传一个文件的方法
* 参数1：string 上传文件的文件域名称(input type=file的name属性值)
* 参数2：string 上传文件的保存目录(savepath)，相对于上传根目录
* 参数3：二维array 需要生成缩略图的数量和尺寸（长度为数量，值为尺寸）
* 返回值：返回一个数组，上传的原图路径和缩略图的路径
*/	
function uploadOneImage($imageName,$saveDir,$thumb=array()){
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
		$upload->savePath  =   $saveDir.'/';	//设置上传文件保存目录,相对于跟目录
		$info   =   $upload->upload();		//调用上传的方法，返回上传信息的二维数组

		if($info){			//上传成功
			//原图的路径
			$img[0]=$info[$imageName]['savepath'].$info[$imageName]['savename'];
			//判断是否生成缩略图
			if($thumb){
				$image = new \Think\Image(); 
				foreach ($thumb as $k => $v) {
					//打开原图
					$image->open($rootPath.$img[0]);
					//定义生成缩略图的保存路径（名字）
					$thumbname=$info[$imageName]['savepath'].$k.'_thumb_'.$info[$imageName]['savename'];
					$image->thumb($v[0],$v[1])->save($rootPath.$thumbname);
					//将缩略图的路径放入img数组中用于返回
					$img[]=$thumbname;
				}
			}
			return array(
				'ok'=>1,
				'img'=>$img     //将图片路径数组返回
			);
		}else{
			return array(
				'ok'=>0,
				'error'=>$upload->getError()	//将上传的错误赋予到error上返回
			);
		}
}
/*
 *定义一个上传多个文件的方法
 *参数1，string 上传文件域的名字(input type=file的name属性值，因为是多张要加[])
 *参数2，string 上传文件的保存目录(savepath)，相对于上传根目录
 *参数3：二维array 需要生成缩略图的数量和尺寸（长度为数量，值为尺寸）
 *返回值：返回一个二维数组，上传的原图路径和缩略图的路径
 */
function uploadMoreImages($imageName,$saveDir,$thumb=array()){
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
		$upload->savePath  =   $saveDir.'/';	//设置上传文件保存目录,相对于跟目录
		$info   =   $upload->upload(array($imageName=>$_FILES[$imageName]));

		if($info){
			//上传成功
			$img=array();		//定义一个数组用来保存返回的数据路径
			foreach ($info as $key => $value) {
				$singleimg=array();		//定义一个数组用来保存每张上传图片原图和缩略图的路径
				$singleimg[0]=$value['savepath'].$value['savename'];
				if($thumb){
					//生成缩略图
					$image = new \Think\Image(); 
					foreach ($thumb as $k => $v) {
						//打开原图
						$image->open($rootPath.$singleimg[0]);
						//定义生成缩略图的保存路径（名字）
						$thumbname=$value['savepath'].$k.'_thumb_'.$value['savename'];
						$image->thumb($v[0],$v[1])->save($rootPath.$thumbname);
						//将缩略图的路径放入singleimg数组中用于返回
						$singleimg[]=$thumbname;
					}
				}
				$img[]=$singleimg;
			}
			return array(
				'ok'=>1,
				'img'=>$img
			);
		}else{
			//上传失败
			return array(
				'ok'=>0,
				'error'=>$upload->getError()
			);
		}
}
/*
*判断相册是否上传
 */
function hasImage($imageName){
	$imgs=$_FILES[$imageName]['error'];	//返回的一个数组
	foreach ($imgs as $key => $value) {
		if($value==0){
			return true;
		}
	}
}

/*
*定义一个删除图片的方法
*参数$imgs，存储图片路径的一维数组
 */
function deleteImages($imgs){
	//取出存储图片的根目录
	$rootPath=C('UPLOAD_ROOT_PATH');
	//取出回收图片的路径
	$backPath=C('BACK_PATH');
	foreach ($imgs as $v) {
		$backname=basename($v);
		@rename($rootPath.$v, $backPath.$backname);
		//@unlink($rootPath.$v);			//屏蔽删除图片的错误
	}
}

/*
定义一个发送邮件的方法
参数1：接收的邮箱地址
参数2：邮箱内容
参数3：邮箱的标题
 */
function sendEmail($address,$content,$title){
         require './PHPMailer/class.phpmailer.php';
                        $mail             = new PHPMailer();
                        /*服务器相关信息*/
                        $mail->IsSMTP();                        //设置使用SMTP服务器发送
                        $mail->SMTPAuth   = true;               //开启SMTP认证
                        $mail->Host       = 'smtp.163.com';   	    //设置 SMTP 服务器,自己注册邮箱服务器地址
                        $mail->Username   = '17717034317';  		//发信人的邮箱用户名
                        $mail->Password   = 'hjxqzhzcoubhwvva';        //发信人的邮箱密码
                        /*内容信息*/
                        $mail->IsHTML(true); 			         //指定邮件内容格式为：html
                        $mail->CharSet    ="UTF-8";			     //编码
                        $mail->From       = '17717034317@163.com';	 		 //发件人完整的邮箱名称
                        $mail->FromName   ="掌门人";			 //发信人署名
                        $mail->Subject    =$title;  			 //信的标题
                        $mail->MsgHTML($content);  				 //发信主体内容
                        //$mail->AddAttachment("fish.jpg");	     //附件
                        /*发送邮件*/
                        $mail->AddAddress($address);  			 //收件人地址
                        //使用send函数进行发送
                        if($mail->Send()) {
                           return true;
                        } else {
                            return false; 
                        } 
}
