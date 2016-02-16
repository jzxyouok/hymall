<?php 
/*
* ����һ������xss�����ķ���
*/
function removeXss($val){
    static $obj=null;
    if($obj===null){
        require './HTMLPurifier/HTMLPurifier.includes.php';
        $obj  = new HTMLPurifier();
    }
    return $obj->purify($val);
}

//����һ����ӡ����ķ���
function p($val){
	echo '<pre>';
	print_r($val);
}

/*
* ����һ���ϴ�һ���ļ��ķ���
* ����1��string �ϴ��ļ����ļ�������(input type=file��name����ֵ)
* ����2��string �ϴ��ļ��ı���Ŀ¼(savepath)��������ϴ���Ŀ¼
* ����3����άarray ��Ҫ��������ͼ�������ͳߴ磨����Ϊ������ֵΪ�ߴ磩
* ����ֵ������һ�����飬�ϴ���ԭͼ·��������ͼ��·��
*/	
function uploadOneImage($imageName,$saveDir,$thumb=array()){
	//ִ���ϴ��ļ���ȡ�����õ������ϴ����ļ����ͺͱ����Ŀ¼��
		$rootPath=C('UPLOAD_ROOT_PATH');
		$ext=C('UPLOAD_ALLOW_EXT');
		//ȡ��php.ini���������ϴ������ļ��Ĵ�С����
		$upload_max_filesize=(int)ini_get('upload_max_filesize');
		//ȡ�����õ��ϴ��ļ��Ĵ�С��php.ini�еıȽ�ȡ��Сֵ
		$upload_file_size=(int)C('UPLOAD_FILE_SIZE');
		$upload_max_size=min($upload_max_filesize,C('upload_file_size'));
		//ʵ�����ϴ�����
		$upload = new \Think\Upload();  
		$upload->maxSize   =   $upload_max_size*1024*1024;	//�����ϴ����ļ���С����λ���ֽڣ�
		$upload->exts      =   $ext;	//�����ϴ����ļ�����
		$upload->rootPath  =   $rootPath;	//�����ϴ��ļ���Ŀ¼
		$upload->savePath  =   $saveDir.'/';	//�����ϴ��ļ�����Ŀ¼,����ڸ�Ŀ¼
		$info   =   $upload->upload();		//�����ϴ��ķ����������ϴ���Ϣ�Ķ�ά����

		if($info){			//�ϴ��ɹ�
			//ԭͼ��·��
			$img[0]=$info[$imageName]['savepath'].$info[$imageName]['savename'];
			//�ж��Ƿ���������ͼ
			if($thumb){
				$image = new \Think\Image(); 
				foreach ($thumb as $k => $v) {
					//��ԭͼ
					$image->open($rootPath.$img[0]);
					//������������ͼ�ı���·�������֣�
					$thumbname=$info[$imageName]['savepath'].$k.'_thumb_'.$info[$imageName]['savename'];
					$image->thumb($v[0],$v[1])->save($rootPath.$thumbname);
					//������ͼ��·������img���������ڷ���
					$img[]=$thumbname;
				}
			}
			return array(
				'ok'=>1,
				'img'=>$img     //��ͼƬ·�����鷵��
			);
		}else{
			return array(
				'ok'=>0,
				'error'=>$upload->getError()	//���ϴ��Ĵ����赽error�Ϸ���
			);
		}
}
/*
 *����һ���ϴ�����ļ��ķ���
 *����1��string �ϴ��ļ��������(input type=file��name����ֵ����Ϊ�Ƕ���Ҫ��[])
 *����2��string �ϴ��ļ��ı���Ŀ¼(savepath)��������ϴ���Ŀ¼
 *����3����άarray ��Ҫ��������ͼ�������ͳߴ磨����Ϊ������ֵΪ�ߴ磩
 *����ֵ������һ����ά���飬�ϴ���ԭͼ·��������ͼ��·��
 */
function uploadMoreImages($imageName,$saveDir,$thumb=array()){
	//ִ���ϴ��ļ���ȡ�����õ������ϴ����ļ����ͺͱ����Ŀ¼��
		$rootPath=C('UPLOAD_ROOT_PATH');
		$ext=C('UPLOAD_ALLOW_EXT');
		//ȡ��php.ini���������ϴ������ļ��Ĵ�С����
		$upload_max_filesize=(int)ini_get('upload_max_filesize');
		//ȡ�����õ��ϴ��ļ��Ĵ�С��php.ini�еıȽ�ȡ��Сֵ
		$upload_file_size=(int)C('UPLOAD_FILE_SIZE');
		$upload_max_size=min($upload_max_filesize,C('upload_file_size'));
		//ʵ�����ϴ�����
		$upload = new \Think\Upload();  
		$upload->maxSize   =   $upload_max_size*1024*1024;	//�����ϴ����ļ���С����λ���ֽڣ�
		$upload->exts      =   $ext;	//�����ϴ����ļ�����
		$upload->rootPath  =   $rootPath;	//�����ϴ��ļ���Ŀ¼
		$upload->savePath  =   $saveDir.'/';	//�����ϴ��ļ�����Ŀ¼,����ڸ�Ŀ¼
		$info   =   $upload->upload(array($imageName=>$_FILES[$imageName]));

		if($info){
			//�ϴ��ɹ�
			$img=array();		//����һ�������������淵�ص�����·��
			foreach ($info as $key => $value) {
				$singleimg=array();		//����һ��������������ÿ���ϴ�ͼƬԭͼ������ͼ��·��
				$singleimg[0]=$value['savepath'].$value['savename'];
				if($thumb){
					//��������ͼ
					$image = new \Think\Image(); 
					foreach ($thumb as $k => $v) {
						//��ԭͼ
						$image->open($rootPath.$singleimg[0]);
						//������������ͼ�ı���·�������֣�
						$thumbname=$value['savepath'].$k.'_thumb_'.$value['savename'];
						$image->thumb($v[0],$v[1])->save($rootPath.$thumbname);
						//������ͼ��·������singleimg���������ڷ���
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
			//�ϴ�ʧ��
			return array(
				'ok'=>0,
				'error'=>$upload->getError()
			);
		}
}
/*
*�ж�����Ƿ��ϴ�
 */
function hasImage($imageName){
	$imgs=$_FILES[$imageName]['error'];	//���ص�һ������
	foreach ($imgs as $key => $value) {
		if($value==0){
			return true;
		}
	}
}

/*
*����һ��ɾ��ͼƬ�ķ���
*����$imgs���洢ͼƬ·����һά����
 */
function deleteImages($imgs){
	//ȡ���洢ͼƬ�ĸ�Ŀ¼
	$rootPath=C('UPLOAD_ROOT_PATH');
	//ȡ������ͼƬ��·��
	$backPath=C('BACK_PATH');
	foreach ($imgs as $v) {
		$backname=basename($v);
		@rename($rootPath.$v, $backPath.$backname);
		//@unlink($rootPath.$v);			//����ɾ��ͼƬ�Ĵ���
	}
}

/*
����һ�������ʼ��ķ���
����1�����յ������ַ
����2����������
����3������ı���
 */
function sendEmail($address,$content,$title){
         require './PHPMailer/class.phpmailer.php';
                        $mail             = new PHPMailer();
                        /*�����������Ϣ*/
                        $mail->IsSMTP();                        //����ʹ��SMTP����������
                        $mail->SMTPAuth   = true;               //����SMTP��֤
                        $mail->Host       = 'smtp.163.com';   	    //���� SMTP ������,�Լ�ע�������������ַ
                        $mail->Username   = '17717034317';  		//�����˵������û���
                        $mail->Password   = 'hjxqzhzcoubhwvva';        //�����˵���������
                        /*������Ϣ*/
                        $mail->IsHTML(true); 			         //ָ���ʼ����ݸ�ʽΪ��html
                        $mail->CharSet    ="UTF-8";			     //����
                        $mail->From       = '17717034317@163.com';	 		 //��������������������
                        $mail->FromName   ="������";			 //����������
                        $mail->Subject    =$title;  			 //�ŵı���
                        $mail->MsgHTML($content);  				 //������������
                        //$mail->AddAttachment("fish.jpg");	     //����
                        /*�����ʼ�*/
                        $mail->AddAddress($address);  			 //�ռ��˵�ַ
                        //ʹ��send�������з���
                        if($mail->Send()) {
                           return true;
                        } else {
                            return false; 
                        } 
}
