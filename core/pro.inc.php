<?php

function addPro(){
	$arr=$_POST;
	// var_dump($_POST);
	// exit();
	$arr['pubTime']=time();
	$path="./uploads";
	$uploadFiles=uploadFile($path);
	// var_dump($uploadFiles);
	// echo '<hr/>';
	
	if (is_array($uploadFiles)&&uploadFiles) {
		foreach ($uploadFiles as $key => $uploadFile) {
			thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
			thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
			thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
			thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);

		}
	}
	
	$res=insert("imooc_pro",$arr);
	$pid=getInsertId();
	if ($res&&$pid) {
		//var_dump($uploadFiles);这里要判断一下。is_array($result = xxxxxxxxx)?null:$result = array();
		foreach ($uploadFiles as $uploadFile) {
			$arr1['pid']=$pid;
			$arr1['albumPath']=$uploadFile['name'];
			addAlbum($arr1);
		}
		$mes="<p>添加成功！</p><a href='addPro.php' target='mainFrame'>继续添加</a>|<a href='listPro.php' target='mainFrame'> 查看商品列表</a>";
	}else{
		foreach ($uploadFiles as $uploadFile) {
			if (file_exists("../image_800/".$uploadFile['name'])) {
				unlink("../image_800/".$uploadFile['name']);
			}
			if (file_exists("../image_50/".$uploadFile['name'])) {
				unlink("../image_50/".$uploadFile['name']);
			}
			if (file_exists("../image_220/".$uploadFile['name'])) {
				unlink("../image_220/".$uploadFile['name']);
			}
			if (file_exists("../image_350/".$uploadFile['name'])) {
				unlink("../image_350/".$uploadFile['name']);
			}
		}
		$mes="添加失败！</p><a href='addPro.php' target='mainFrame'>重新添加</a>";
	}
	return $mes;
}

function editPro($id){

	$arr=$_POST;
//	var_dump($_POST);
	$path="./uploads";
	$uploadFiles=uploadFile($path);
	echo '<hr/>';
	var_dump($uploadFiles);
	if (is_array($uploadFile)&&$uploadFiles) {
		foreach ($uploadFiles as $key => $uploadFile) {
			thumb($path."/".$uploadFile['name'],"../image_50".$uploadFile['name'],50,50);
			thumb($path."/".$uploadFile['name'],"../image_220".$uploadFile['name'],220,220);
			thumb($path."/".$uploadFile['name'],"../image_350".$uploadFile['name'],350,350);
			thumb($path."/".$uploadFile['name'],"../image_800".$uploadFile['name'],800,800);
		}
	}
	$where="id={$id}";
	$res=update("imooc_pro",$arr,$where);
	$pid=$id;
	// echo '<hr/>';
	// echo $res;
	// echo '<hr/>';
	// echo $pid;
	// echo '<hr/>';
	if($res&&$pid){
		if ($uploadFiles&&is_array($uploadFiles)) {
			foreach ($uploadFiles as $uploadFile) {
				$arr1['pid']=$pid;
				$arr1['albumPath']=$uploadFile['name'];
				addAlbum($arr1);
			}
		}
		$mes="<p>编辑成功！</p><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
	}else{
		if (is_array($uploadFiles)&&$uploadFiles) {
			foreach ($uploadFiles as $uploadFile) {
				if(file_exists("../image_800/".$uploadFile['name'])){
					unlink("../image_800/".$uploadFile['name']);
				}
				if(file_exists("../image_50/".$uploadFile['name'])){
					unlink("../image_50/".$uploadFile['name']);
				}
				if(file_exists("../image_220/".$uploadFile['name'])){
					unlink("../image_220/".$uploadFile['name']);
				}
				if(file_exists("../image_350/".$uploadFile['name'])){
					unlink("../image_350/".$uploadFile['name']);
				}
			}
		}
			$mes="<p>编辑失败!</p><a href='listPro.php' target='mainFrame'>重新编辑</a>";
		}
	return $mes;
}

function delPro($id){
	$where="id=$id";
	$res=delete("imooc_pro",$where);
	$proImgs=getAllImgProId($id);

	if ($proImgs&&is_array($proImgs)) {
		foreach ($proImgs as $proImg) {
			if(file_exists("uploads/".$proImg['albumPath'])){
				unlink("uploads/".$proImg['albumPath']);
			}
			if(file_exists("../image_50/".$proImg['albumPath'])){
				unlink("../image_50/".$proImg['albumPath']);
			}
			if(file_exists("../image_220/".$proImg['albumPath'])){
				unlink("../image_220/".$proImg['albumPath']);
			}
			if(file_exists("../image_350/".$proImg['albumPath'])){
				unlink("../image_350/".$proImg['albumPath']);
			}
			if(file_exists("../image_800/".$proImg['albumPath'])){
				unlink("../image_800/".$proImg['albumPath']);
			}	
		}
	}
	$where1="pid={$id}";
	$res1=delete("imooc_album",$where1);
	if($res&&$res1){
		$mes="删除成功！<br/><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
	}else{
		$mes="删除失败！<br/><a href='listPro.php' target='mainFrame'>重新删除</a>";
	}
	return $mes;
}

function getAllProByAdmin(){
	$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from imooc_pro as p join imooc_cate c on p.cId=c.id";
	$rows=fetchAll($sql);
	return $rows;
}


function getAllImgByProId($id){
	$sql="select a.albumPath from imooc_album a where pid={$id}";
	$rows=fetchAll($sql);
	return $rows;
}



function getProById($id){
	$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from imooc_pro as p join imooc_cate c on p.cId=c.id where p.id={$id}";
	echo $sql;
	$row=fetchOne($sql);
	return $row;
}


function checkProExist($cid){
	$sql="select * from imooc_pro where cId={$cid}";
	$rows=fetchAll($sql);
	return $rows;
}


function getAllPros(){
	$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from imooc_pro as p join imooc_cate c on p.cId=c.id";
	$rows=fetchAll($sql);
	return $rows;
}

function getProsByCid($cid){
	$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from imooc_pro as p join imooc_cate c on p.cId=c.id where p.cId={$cid} limit 4";
	$rows=fetchAll($sql);
	return $rows;
}


function getSmallProsByCid($cid){
	$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from imooc_pro as p join imooc_cate c on p.cId=c.id where p.cId={$cid} limit 4,4";
	$rows=fetchAll($sql);
	return $rows;
}



function getProInfo(){
	$sql="select id,pName from imooc_pro order by id asc";
	$rows=fetchAll($sql);
	return $rows;
}


?>