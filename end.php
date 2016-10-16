<html>
<head>
	<title>movie recommender system</title>
</head>
<link rel="stylesheet" href="div.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<body>
<div class="ed">
<?php
session_start();
$id=$_SESSION['a'];
$link=mysqli_connect('localhost','root','','movie');
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_general_ci'");

if(isset($_POST['sum']))
{
	$l1=$_POST['l1'];
	$first=$_POST['rank1'];
	$second=$_POST['rank2'];
	$third=$_POST['rank3'];

	$sql="UPDATE user_rd SET cos_rs_value='$l1', first='$first', second='$second', third='$third' WHERE user_id='$id'";
	mysqli_query($link,$sql);
    echo "實驗完成";
}

?>
<div class="ed2">
<input type ="button" onclick="javascript:location.href='log.php'" value="回登入頁"></input>
</div>
</div>
</body>
</html>
