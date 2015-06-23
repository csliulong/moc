<?php
function buildInfo(){
	if (!$_FILES) {
		return;
	}
	$i=0;
	foreach ($_FILES as $v) {
		if (is_string($v['name'])) {
			$files[$i]=$v;
			$i++;
		}else{
			foreach ($v['name'] as $key => $val) {
				$files[$i]['name']=$val;
				$files[$i]['size']=$v['size'][$key];
				$files[$i]['tmp_name']=$v['tmp_name'][$key];
				$files[$i]['error']=$v['error'][$key];
				$files[$i]['type']=$v['type'][$key];
				$i++;
			}
		}
	}
	return $files;
}


function uploadFile($path="uploads",$allowExt=array("gif","jpeg","png","wbmp","jpg"),$maxSize=1920927152,$imgFlag=true){
	if (!file_exists($path)) {
		mkdir($path,0777,true);
	}
	$i=0;
	$files=buildInfo();
	// var_dump($files);
	// exit();
	if (!($files&&is_array($files))) {
		return;
	}

	foreach ($files as $file) {
		if ($file['error']===UPLOAD_ERR_OK) {
			$ext=getExt($file['name']);
			if (!in_array($ext, $allowExt)) {
				exit("非法文件类型");
			}

			if ($imagFlag) {
				if (!getimagesize($file['tmp_name'])) {
					exit("不是真正的图片类型");
				}
			}

			if ($file['size']>$maxSize) {
				exit("上传文件过大");
			}

			if (!is_uploaded_file($file['tmp_name'])) {
				exit("不是通过HTTP POST方式上传上来的");
			}

			$filename=getUniName().".".$ext;

			$destination=$path."/".$filename;
//			var_dump($uploadedFiles);
// 			echo $filename;
// 			echo $destination;
// 			echo '<hr/>';
			if (move_uploaded_file($file['tmp_name'], $destination)) {
				$file['name']=$filename;
//				unset($file['tmp_name'],$file['size'],$file['type']);
				$uploadedFiles[$i]=$file;

				$i++;
			}

		}else{
			switch ($file['error']) {
				case '1':
					$mes="超过了配置文件上传文件的大小";
					break;
					
				case '2':
					$mes="超过了表彰设置上传文件的大小";
					break;

				case '3':
					$mes="文件部分被上传";
					break;
					
				case '4':
					$mes="没有文件补上传111";
					break;

				case '5':
					$mes="啥也没有";
					break;
					
				case '6':
					$mes="没有找到临时目录";
					break;

				case '7':
					$mes="文件不可写";
					break;
					
				case '8':
					$mes="由于PHP的扩展程序中断了文件上传";
					break;											
			}
			echo $mes;

		}
	}
	// var_dump($uploadedFiles);
	// echo '<hr/>';
	// echo '<hr/>';
	return $uploadedFiles;
}

?>
