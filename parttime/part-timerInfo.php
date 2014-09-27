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
	
	<link rel="stylesheet" href="css/main.css">
<style>
	.jumbotron {margin:10px;}
	.glyphicon-ok {color:#5CB85C;}
	a {width:100%;}
</style>
<script type="text/javascript"> //获取batch
	function GetRequest() {
		   var url = location.search; //获取url中"?"符后的字串
		   var theRequest = new Object();
		   if (url.indexOf("?") != -1) {
		      var str = url.substr(1);
		      strs = str.split("&");
		      for(var i = 0; i < strs.length; i ++) {
		         theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
		      }
		   }
		   return theRequest;
		}
</script>
</head>
<body>
	<div class="jumbotron">
		<p><h4 class="text-danger">报名成功的人员信息如下：</h4></p>
		<span id="number" class="text-warning"></span>
		<script type="text/javascript">
			var Request = new Object();
			Request = GetRequest();
			var batch = Request['batch'];
				$.post(
					"inner_info.php",
					{
						"batch" : batch
					},
					function(batch)
					{
						$("#number").html(batch)
					}
					);
		</script>
	</div>
</body>
</html>