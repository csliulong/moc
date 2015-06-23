<?php
require_once '../include.php';
checkLogined();
$order=$_REQUEST['order']?$_REQUEST['order']:null;
$orderBy=$order?"order by p.".$order:null;

$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
$where=$keywords?"where p.pName like '%{$keywords}%'":null;

$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from imooc_pro as p join imooc_cate c on p.cId=c.id {$where}";

$totalRows=getResultNum($sql);
$pageSize=2;

$totalPage=ceil($totalRows/$pageSize);
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>=$totalPage)$page=$totalPage;

$offset=($page-1)*$pageSize;

$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from imooc_pro as p join imooc_cate c on p.cId=c.id {$where} {$orderBy} limit {$offset},{$pageSize}";
$rows=fetchAll($sql);

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link href="css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="lib/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="lib/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
<link href="lib/font-awesome/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="lib/iconfont/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]--><title>资讯列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span class="c-gray en">&gt;</span> 资讯列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
  <div class="protext-c">
   日期范围：
    <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;">
    -
    <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;">
    <input type="text" name="" id="" placeholder=" 商品名称" style="width:250px" class="input-text"><button name="" id="" class="btn btn-success" type="submit"><i class="icon-search"></i> 搜搜商品</button>
   商品价格： 
    <select id="" class="input-text" style="width:120px;" onchange="change(this.value)">
      <option>-请选择-</option>
      <option value="iPrice asc">由低到高</option>
      <option value="iPrice desc">由高到低</option>
    </select>
   上价时间： 
    <select id="" class="input-text" style="width:120px;" onchange="change(this.value)">
      <option>-请选择-</option>
      <option value="pubTime desc">最新发表</option>
      <option value="pubTime asc">历史发布</option>
    </select>
  </div>
  <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a> <a class="btn btn-primary radius" onclick="article_add('','','添加商品','addPro.php')" href="javascript:;"><i class="icon-plus"></i> 添加商品</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
  <table class="table table-border table-bordered table-bg table-hover table-sort">
    <thead>
      <tr class="text-c">
        <th width="50">ID<input name="" type="checkbox" value=""></th>
        <th width="400">商品名称</th>
        <th width="100">商品分类</th>
        <th width="50">是否上架</th>
        <th>上架时间</th>
        <th width="50">价格</th>
        <th width="50">更新时间</th>
        <th width="60">发布状态</th>
        <th width="100">操作</th>
      </tr>
    </thead>
    <?php foreach($rows as $row):?>
    <tbody>
      <tr class="text-c">
        <td><input name="" type="checkbox" value="<?php echo $row['id'];?>" id="c<?php echo $row['id'];?>"><?php echo $row['id'];?></td>
        <td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('10001','650','','查看','pro-list.php?id=<?php echo $row['id'];?>')" title="查看"><?php echo $row['pName'];?></u></td>
        <td><?php echo $row['cName'];?></td>
        <td><?php echo $row['isShow']==1?"上架":"下架";?></td>
        <td class="text-l"><?php echo date("Y-m-d H:i:s",$row['pubTime']);?></td>
        <td class="text-c"><?php echo $row['iPrice'];?></td>
        <td>待用</td>
        <td class="article-status"><span class="label label-success radius">已发布</span></td>
        <td class="f-14 article-manage">
        <a style="text-decoration:none" onClick="article_xiajia(this,'10001')" href="javascript:;" title="下架"><i class="icon-hand-down"></i></a> 
        <a style="text-decoration:none" class="ml-5" onClick="article_edit('10001','750','500','商品编辑','editPro.php?id=<?php echo $row['id'];?>')" href="javascript:;" title="编辑"><i class="icon-edit"></i></a> 
        <a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="icon-trash"></i></a>
        </td>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table>
    <?php if($totalRows>$pageSize):?>
      <tr>
        <td colspan="9"><?php echo showPage($page,$totalPage,"keywords={$keywords}&order={$order}");?></td>
      </tr>
    <?php endif;?>
  <div id="pageNav" class="pageNav"></div>
</div>
<script type="text/javascript" src="lib/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer1.8/layer.min.js"></script>
<script type="text/javascript" src="lib/laypage/laypage.js"></script> 
<script type="text/javascript" src="lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="lib/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/H-ui.js"></script>
<script type="text/javascript" src="js/H-ui.admin.js"></script> 
<script type="text/javascript" src="js/H-ui.admin.doc.js"></script>

<script type="text/javascript">
$('.table-sort').dataTable({
	"lengthMenu":false,//显示数量选择 
	"bFilter": false,//过滤功能
	"bPaginate": false,//翻页信息
	"bInfo": false,//数量信息
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,8]}// 制定列不参与排序
	]
});
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>