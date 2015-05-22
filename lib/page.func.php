<?php

function showPage($page,$totalPage,$where=NULL,$sep="&nbsp;"){
	$where=($where==null)?null:"&".$where;
	$url=$_server['PHP_SELF'];
	$index=($page==1)?"首页":"<a href='{$url}?page=1{$where}'>首页</a>";
	$last=($page==$totalPage)?"尾页":"<a href='{$url}?page={$totalPage}{$where}'>尾页</a>";
	$prevPage=($page>=1)?$page-1:1;
	$nextPage=($page>=$totalPage)?$totalPage:$page+1;
	$prev=($page==1)?"上一页":"<a href='{$url}?page={$prevPage}{$where}'>上一页</a>";
	$next=($page==$totalPage)?"下一页":"<a href='{$url}?page={$nextPage}{$where}'>下一页</a>";

	$str="总共{$totalPage}页/当前是第{$page}页";

	for ($i=1; $i <= $totalPage; $i++) { 
		if ($page==$i) {
			$p.="[{$i}]";
		}else{
			$p.="<a href='{$url}?page={$i}{$where}'>[{$i}]</a>";
		}
	}

	$pageStr=$str.$sep . $index.$sep. $prev.$sep . $p.$sep . $next.$sep . $last;
	return $pageStr;



}

/*require_once '../include.php';
$sql="select * from imooc_admin";
$totalRows=getResultNum($sql);

echo $totalRows;
$pageSize=2;

$totalPage=ceil($totalRows/$pageSize);
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
if ($page<1||$page==NULL||!is_numeric($page)) {
	$page=1;
}

if ($page>=$totalPage) $page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select * from imooc_admin limit {$offset},{$pageSize}";
//echo $sql;
$rows=fetchAll($sql);

//var_dump($rows);
foreach ($rows as $row) {
	echo "编号：".$row['id'],"<br/>";
	echo "管理员的名称".$row['username'],"<hr/>";
}
echo $totalPage;
echo showPage($page,$totalPage);
echo "<hr/>";
echo showPage($page,$totalPage,"cid=5&pid=88888");
*/

/*require_once '../include.php';
$sql="select * from imooc_admin";
$pageSize=2;
$totalRows=getResultNum($sql);
$totalPage=ceil($totalRows/$pageSize);
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$rows=getAdminByPage($page,$pageSize);
foreach ($rows as $row) {
	echo "编号：".$row['id'],"<br/>";
	echo "管理员的名称".$row['username'],"<hr/>";
}
echo showPage($page,$totalPage);
echo "<hr/>";
echo showPage($page,$totalPage,"cid=5&pid=88888");*/





?>