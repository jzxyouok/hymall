<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'shop', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '123', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'it_', // 数据库表前缀
	'DB_CHARSET'=> 'utf8', // 字符集

	 //定义上传文件保存的路径
    'UPLOAD_ROOT_PATH'=>'./Public/Uploads/',
	//定义允许上传的文件大小
    'UPLOAD_FILE_SIZE'=>'3M',
    //定义允许上传文件的后缀
    'UPLOAD_ALLOW_EXT'=>array('jpg','jpeg','bmp','png','gif'),
    //定义删除图片回收图片的路径
    'BACK_PATH'=>'./Public/Back/',
    //定义前台取图片的路径
    'IMG_SRC'=>'/Public/Uploads/',

	'DEFAULT_FILTER'        =>  'trim,removeXss', //更新数据过滤
);