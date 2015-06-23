<?php
require_once '../include.php';
$id=$_REQUEST['id'];
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
<link href="lib/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
<link href="lib/font-awesome/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="lib/iconfont/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>修改密码</title>
</head>
<body>
<div class="pd-20">
  <form action="doAdminAction.php?act=changePwd&id=<?php echo $id; ?>" method="post" class="form form-horizontal" id="form-user-password">
    <div class="row cl">
      <label class="form-label col-4"><span class="c-red">*</span>新密码：</label>
      <div class="formControls col-4">
        <input type="password" class="input-text" autocomplete="off" placeholder="密码" name="password" id="password" plugin="passwordStrength" datatype="*6-18" nullmsg="请输入密码！" >
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="Validform_checktip Validform_right" style="display: none;"></div>
    <div class="passwordStrength" style="">
      <b class="form-label col-4">密码强度：</b> <span class="bgStrength">弱</span><span>中</span><span class="last">强</span>
    </div>
    <div class="row cl">
      <label class="form-label col-4"><span class="c-red">*</span>确认密码：</label>
      <div class="formControls col-4">
        <input type="password" class="input-text" autocomplete="off" placeholder="密码" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <div class="col-8 col-offset-4">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" src="lib/jquery.min.js"></script> 
<script type="text/javascript" src="lib/Validform_v5.3.2.js"></script> 
<script type="text/javascript" src="lib/layer1.8/layer.min.js"></script> 
<script type="text/javascript" src="lib/laypage/laypage.js"></script> 
<script type="text/javascript" src="js/H-ui.js"></script> 
<script type="text/javascript" src="js/H-ui.admin.js"></script> 
<script type="text/javascript" src="js/H-ui.admin.doc.js"></script> 
<script type="text/javascript" src="lib/passwordStrength-min.js"></script>
<script>
$(function(){
  //$(".registerform").Validform();  //就这一行代码！;    
  $("#form-user-password").Validform({
    tiptype:2,
    usePlugin:{
      passwordstrength:{
        minLen:6,//设置密码长度最小值，默认为0;
        maxLen:18,//设置密码长度最大值，默认为30;
        trigger:function(obj,error){
          //该表单元素的keyup和blur事件会触发该函数的执行;
          //obj:当前表单元素jquery对象;
          //error:所设密码是否符合验证要求，验证不能通过error为true，验证通过则为false;
          
          //console.log(error);
          if(error){
            obj.parent().next().find(".Validform_checktip").show();
            obj.parent().next().find(".passwordStrength").hide();
          }else{
            obj.parent().next().find(".Validform_checktip").hide();
            obj.parent().next().find(".passwordStrength").show(); 
          }
        }
      }
    }
  });
})

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