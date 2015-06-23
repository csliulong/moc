<?php
function addCate(){
	$arr=$_POST;
	if (insert("imooc_cate",$arr)) {
		$mes="分类添加成功！<br/><a href='addCate.php'>继续添加</a>|<a href='listCate.php'>查看分类</a>";
	}else{
		$mes="分类添加失败！<br/><a href='addCate.php'>重新添加</a>|<a href='listCate.php'>查看分类</a>";
	}
	return $mes;
}

function getCateById($id){
	$sql="select id,cName,sel_Sub from imooc_cate where id={$id}";
	return fetchOne($sql);
}

function editCate($where){
	$arr=$_POST;
	if (update("imooc_cate",$arr,$where)) {
		$mes="分类修改成功！<br/><a href='listCate.php'>继续修改</a>";
	}else{
		$mes="分类修改失败！<br/><a href='listCate.php'>重新修改</a>";
	}
	return $mes;
}

function getCateByPage($page,$pageSize=2){

	$sql="select * from imooc_cate";
	global $totalRows;
	$totalRows=getResultNum($sql);

	global $totalPage;
	$totalPage=ceil($totalRows/$pageSize);

	if ($page<1||$page==null||!is_numeric($page)) $page=1;
	if ($page>=$totalPage)$page=$totalPage;

	$offset=($page-1)*$pageSize;

	$sql="select id,cName,sel_Sub from imooc_cate order by id asc limit {$offset},{$pageSize}";
	$rows=fetchAll($sql);
	return $rows;

}



function delCate($id){
	$res=checkProExist($id);
	if (!$res) {
		$where="id=".$id;
		if (delete("imooc_cate",$where)) {
			$mes="分类删除成功！<br/><a href='listCate.php'>查看分类</a>|<a href='addCate.php'>添加分类</a>";
		}else{
			$mes="删除失败！<br/><a href='listCate.php'>请重新操作</a>";
		}
		return $mes;
	}else{
		alertMes("不能删除分类，请先删除该分类下的商品","listPro.php");
	}
}


function getAllCate(){
	$sql="select id,cName from imooc_cate";
	$rows=fetchAll($sql);
	return $rows;
}

?>