<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">


    <link rel="stylesheet" href="/Public/index/css/bootstrap.css"/>
    <link rel="stylesheet" href="/Public/index/css/style.css"/>
    <script src="/Public/index/js/jquery-1.9.1.min.js"></script>
    <script src="/Public/index/js/js.js"></script>
    <script src="/Public/index/js/jquery.js"></script>
    <script src="/Public/index/js/myjs.js"></script>
    <meta name="viewport" content="width=750, user-scalable=no, target-densitydpi=device-dpi"/>
<title>注册</title>
</head>
<body>

<div class="rol cw-tit fhfs">
    <div class="m-box">
        用户注册
    </div>
</div>



<form name="myform" action="/Index/User/reg" method="POST">
<div class="rol">
      <div class="m-box zc-list">
          <div>
             <span class="zc-img1"></span>
             <b>用户名</b>
             <input type="text" name="username" id="username" placeholder="请输入用户名" />
          </div>
          <div>
              <span class="zc-img2"></span>
              <b>密码</b>
              <input type="password" name="pwdval" id="pwdval" />
          </div>
          <div>
              <span class="zc-img3"></span>
              <b>确认密码</b>
              <input type="password" name="qrpwdval" id="qrpwdval" />
          </div>
          <div>
              <span class="zc-img4"></span>
              <b>昵称</b>
              <input type="text" name="nichengval" id="nichengval" placeholder="请输入昵称" />
          </div>
          <div>
              <span class="zc-img5"></span>
              <b>邮箱</b>
              <input type="email" name="emailval" id="emailval" placeholder="请输入邮箱" />
          </div>
          <div>
              <span class="zc-img6"></span>
              <b>手机</b>
              <input type="text" name="telval" id="telval" placeholder="请输入手机号码" />
          </div>
          <div class="rol zx-bot">
              <div class="rol xb1">
                  <b>性别</b>
                  <div class="lt">
                      <div class="lt xb-2"><input class="xb" type="radio" name="fex" value="1" checked />男</div>
                      <div class="lt xb-2"><input class="xb" type="radio" name="fex" value="0" />女</div>
                  </div>
              </div>
              <div class="rol dz">
                  <b>地址</b>
                  <select name="addsheng" id="pro_list">
                      <option value="-1">请选择省份</option>
                      <?php if(is_array($prolist)): $i = 0; $__LIST__ = $prolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$prolist): $mod = ($i % 2 );++$i;?><option value="<?php echo ($prolist["region_id"]); ?>"><?php echo ($prolist["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                  <select  name="addshi" id='city_list' style="display: none;">
                      <option value="-1">请选择城市</option>
                  </select>
                  <select name="addxian" id="county_list" style="display: none;">
                      <option value="-1">请选择县区</option>
                  </select>
              </div>
              <div class="rol">
                  <b>补充地址</b>
                  <input type="text" name="bucaddres" id="bucaddres" placeholder="请输入补充地址" />
              </div>
          </div>
      </div>
       <div class="rol zc-an">
           <div><button class="zc btn">注册</button></div>
           <div><span>已有账号？</span><a href="<?php echo U('User/login');?>">登录</a></div>
       </div>
   </div>
</form>
   <script type="text/javascript">
var kaiguan=0;

$(function(e){
	
	//列出市级
	$('#pro_list').bind('change',function(e){
		var proval=this.value;
		if(!$("#city_list").is(":hidden")){
				$("#city_list").hide(100);
			}
			if(!$("#county_list").is(":hidden")){
				$("#county_list").hide(100);
			}
			$('#city_list').empty();
			$('#city_list').append('<option value="-1">请选择城市</option>');
			
			$('#county_list').empty();
			$('#county_list').append('<option value="-1">请选择地区</option>');
			
		if(proval != '-1'){
			$.ajax({
				url:host+'/Admin/User/lookaddres',
				type:'post',
				data:{proval:proval},
				dataType:'json',
				beforeSend:function(xmldata){
					$('#load_jz').removeClass();
					$('#load_jz').addClass('icon-spinner icon-spin icon-large');
					$('#load_jz').show();
				},
				success:function(data){
					$('#load_jz').removeClass();
					if(data.code == 1){
						$('#city_list').empty();
						$('#city_list').append('<option value="-1">请选择城市</option>');
						var sumval=data.infor.sum;
						var cont=data.infor.cont;
						for(i=0;i<sumval;i++){
							$('#city_list').append('<option value="'+cont[i].region_id+'">'+cont[i].region_name+'</option>');
						}
						$("#city_list").show(300);
					}
					
				},
				error:function(error){
					$('#load_jz').removeClass();
					$('#load_jz').addClass('icon-remove-sign');
					document.getElementById('load_jz').style.color='#ff0000';
				}
			});
		}
	});
	
	
	//列出县级
	$('#city_list').bind('change',function(e){
		var proval=this.value;
		if(!$("#county_list").is(":hidden")){
				$("#county_list").hide(100);
			}
			
			$('#county_list').empty();
			$('#county_list').append('<option value="-1">请选择地区</option>');
		if(proval != '-1'){
			$.ajax({
				url:host+'/Admin/User/lookaddres',
				type:'post',
				data:{proval:proval},
				dataType:'json',
				beforeSend:function(xmldata){
					$('#load_jz').removeClass();
					$('#load_jz').addClass('icon-spinner icon-spin icon-large');
					$('#load_jz').show();
				},
				success:function(data){
					$('#load_jz').removeClass();
					if(data.code == 1){
						$('#county_list').empty();
						$('#county_list').append('<option value="-1">请选择城市</option>');
						var sumval=data.infor.sum;
						var cont=data.infor.cont;
						for(i=0;i<sumval;i++){
							$('#county_list').append('<option value="'+cont[i].region_id+'">'+cont[i].region_name+'</option>');
						}
						$("#county_list").show(300);
					}
					
				},
				error:function(error){
					$('#load_jz').removeClass();
					$('#load_jz').addClass('icon-remove-sign');
					document.getElementById('load_jz').style.color='#ff0000';
				}
			});
		}
	});
	
	$(".btn").click(function(e) {
		if($('#username').val()==''){
			alert('请输入用户名');
			$('#username').focus();
			return false;
		}
		if($('#pwdval').val()==''){
			alert('请输入密码');
			$('#pwdval').focus();
			return false;
		}
		if($('#qrpwdval').val()== ''){
			alert('请输入确认密码');
			$('#qrpwdval').focus();
			return false;
		}
		if($('#qrpwdval').val() != $('#pwdval').val()){
			alert('您两次输入的密码不一致！');
			$('#qrpwdval').focus();
			return false;
		}
		if($('#telval').val()== ''){
			alert('请输入你的联系电话！');
			$('#telval').focus();
			return false;
		}
		$("form[name='myform']").submit();
	});
	


});
</script>


</body>
</html>