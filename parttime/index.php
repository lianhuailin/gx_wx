<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<title>兼职报名 - 工学助手</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="lib/Bootstrap/css/bootstrap.min.css">
	<script src="lib/jQuery/jquery-1.11.1.min.js"></script>
	<script src="lib/Bootstrap/js/bootstrap.min.js"></script>
	<script src="lib/jQuery/myjs.js"></script>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<nav>
	    <span class="navbar-brand">工学兼职报名 - 
			<span id="batch" class="danger">
		    	<script type="text/javascript">
			    	var Request = new Object();
					Request = GetRequest();
					var batch = Request['batch'];
					if(batch =='')
						document.write("出错了！请勿报名！");
					else
						document.write(batch);
			</script>
		</span>
	</span>
    </nav>
    <div class="hire">
	    <span id='parttimeInfo'></span>
    	</p>剩余名额：<span id="remain" class='hire'></span>个
    </div>
    <div>
    	<h7><small>&nbsp;&nbsp;&nbsp;想取消报名或咨询请联系：661680或682231</small></h7><br>
    	<script type="text/javascript">
    		var Request = new Object();
			Request = GetRequest();
			var batch = Request['batch'];
			var url = "<a class='btn-lg' href='success.php?batch="+batch+"'>查看报名成功人员</a>";
			document.write(url);
    	</script>
    </div>
	<form>
		<div class="form-group">

			<label class="control-label">姓名</label>
			<input type="text" class="form-control indispensable" id="name" placeholder="请输入您的真实姓名">
		</div>

		<div class="form-group">
			<label class="control-label">性别</label>
			<select class="form-control" id="sex">
				<option>男</option>
				<option>女</option>
			</select>
		</div>

		<div class="form-group">
			<label for="" class="control-label">长号</label>
			<input type="text" class="form-control indispensable" id="mobile" placeholder="请输入可加飞信的长号">
		</div>

		<div class="form-group">
			<label for="" class="control-label">短号</label>
			<input type="text" class="form-control" id="tele" placeholder="广轻短号(选填)">
		</div>

		<div class="form-group">
			<label for="" class="control-label">班级</label>
			<input type="text" class="form-control indispensable" id="class" placeholder="例：工学助手1班">
		</div>

		<div class="form-group">
			<label for="" class="control-label">备注</label>
			<input type="text" class="form-control" id="ps" placeholder="选填">
		</div>

		<div class="form-group">
			<button type="button" class="btn btn-lg btn-success" id="signUp" data-loading-text="正在提交...">报名</button>
		</div>
	</form>
	<script type="text/javascript">
    	var Request = new Object();
			Request = GetRequest();
			var batch = Request['batch'];
			switch(batch)
			{
				case '3':
					$("#parttimeInfo").html('五星级皇冠假日酒店招聘服务员兼职.<br>要求：女身高不得低于157，男身高不得低于168。<br>待遇：时薪10块，工资每周二到启航打印店结算，包餐包接送。<br>工作时间：27号（周六）下午18:00~22:00。<br>集中时间：27号下午16:00校门口。');
					break;

				case '4':
					$("#parttimeInfo").html('注意：本次兼职人员已满，报名无效！');
					break;

				case '2':
					$("#parttimeInfo").html('中国移动现招聘校内业务开通员<br>要求：无。<br>待遇：面议。<br>工作时间：自由分配。<br>集中时间：（现在）9月21号21:30一饭三（培训）.（今天）');
					break;

				default:
					$("#parttimeInfo").html('暂时没有兼职提供！');
			}

		//提交表单
		$.post(
			"check.php",
			{
				data : "remain",
				batch : batch
			},
			function(data){
			if (data != "DatabaseERROR")
				$("#remain").html(data);
			else
				$(".hire").html("<h3 style=\"color:red; text-align:center\">数据库连接出错</h3><p style=\"color:#5CB85C; text-align:center\">请尝试<b>刷新</b>或<b>联系工作人员</b></p>");
			}
			);
		$("#signUp").click(function(){
			if (dataOK()){
				$('#signUp').button('loading');
				$.post(
					"post.php",
					{	
						"remain": $("#remain").text(),
						"name"  : $("#name").val(),
						"sex"   : $("#sex").val(),
						"mobile": $("#mobile").val(),
						"tele"  : $("#tele").val(),
						"class" : $("#class").val(),
						"ps": $("#ps").val(),
						"batch" : batch   //-----------------------------------------------批次修改------------------
					},
					function(data){
						if (data == "SUCCESS"){
							$("#signUp").button('reset');
							$("#signUp").html("提交成功！");
							window.location.href="success.php?batch="+batch;
						}else{

						}
					}
				);
			}
		});
	</script>
</body>
</html>