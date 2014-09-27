<?php
	//读入配置文件
	$config = parse_ini_file("config/config.ini");
	$dbUrl = $config['dbUrl'];
	$dbUserName = $config['UserName'];
	$dbPassword = $config['Password'];
	$dbName = $config['dbName'];

	//连接数据库
	$conn = @mysql_connect($dbUrl, $dbUserName, $dbPassword) or die("DatabaseERROR");
	$result = mysql_select_db($dbName, $conn);
	mysql_query("SET NAMES 'UTF8'");

?>