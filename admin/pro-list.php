<?php
require_once '../include.php';
$id=$_REQUEST['id'];
//$id=3;
$sql="select * from imooc_pro where id='{$id}'";
// var_dump($row['cId']);

$row=fetchOne($sql);
$cName="select cName from imooc_cate where id='{$row['cId']}'";
$cName_row=fetchOne($cName);
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

<div class="pd-20">

  <table class="table table-border table-bordered table-bg table-hover table-sort">
          <tr>
            <td width="20%" align="right">商品名称</td>
            <td><?php echo $row['pName'];?></td>
          </tr>
          <tr>
            <td width="20%" align="right">商品类别</td>
            <td><?php echo $cName_row['cName'];?></td>
          </tr>
          <tr>
            <td width="20%" align="right">商品货号</td>
            <td><?php echo $row['pSn'];?></td>
          </tr>
          <tr>
            <td width="20%" align="right">商品数量</td>
            <td><?php echo $row['pNum'];?></td>
          </tr>
          <tr>
            <td width="20%" align="right">商品价格</td>
            <td><?php echo $row['mPrice'];?></td>
          </tr>
          <tr>
            <td width="20%" align="right">原始的价格</td>
            <td><?php echo $row['iPrice'];?></td>
          </tr>
          <tr>
            <td width="20%" align="right">商品图片</td>
            <td>
              <?php
                $proImgs=getAllImgByProId($row['id']);
                // var_dump($proImgs);
                foreach ($proImgs as $img):
              ?>
              <img width="100" height="100" src="uploads/<?php echo $img['albumPath'];?>" alt=""/>&nbsp;&nbsp;
                <?php endforeach;?>
            </td>
          </tr>
          <tr>
            <td width="20%" align="right">是否上架</td>
            <td><?php echo $row['isShow']==1?"上架":"下架";?></td>
          </tr>
          <tr>
            <td width="20%" align="right">是否热卖</td>
            <td><?php echo $row['isHot']==1?"热卖":"正常";?></td>
          </tr>

  </table>
    <span style="display:block;width:80%;">
      商品描述<br/>
      <?php echo $row['pDesc'];?>
    </span>
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
// $('.table-sort').dataTable({
// 	"lengthMenu":false,//显示数量选择 
// 	"bFilter": false,//过滤功能
// 	"bPaginate": false,//翻页信息
// 	"bInfo": false,//数量信息
// 	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
// 	"bStateSave": true,//状态保存
// 	"aoColumnDefs": [
// 	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
// 	  {"orderable":false,"aTargets":[0,8]}// 制定列不参与排序
// 	]
// });
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