<html>
<head><title>movie recommender system</title><head>
<body>
<form>
<link rel="stylesheet" href="div.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<div class="div0">
<div class="div1">
</div>
<div class="div2">
<fieldset><legend>movie</legend> 
<?php
$link=mysqli_connect('localhost','root','','movie');
mysqli_query($link,'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection='utf8_general_ci'");
session_start();
$id=$_SESSION["a"];
$sum=0;
echo "---------------".$id."的電影清單---------------"."<br>";
  echo "<br>";
  $list="SELECT * FROM user WHERE user_id = '".$id."'";
  $reslut=mysqli_query($link,$list);
  //$rows=mysqli_num_rows($result);
  while($record=mysqli_fetch_assoc($reslut))
  {
  	if($record['user_movie']!='')
  	{
  		echo ($sum+1).".".$record['user_movie']."<br>";
  		$sum++;
  	}
  }
  echo "----------------------------------------------"."<br>"; 
  echo "目前總有".$sum."部電影";
  
?>
</fieldset>
<div class="div3">
<input type ="button" onclick="javascript:location.href='index.php'" value="回上一頁"></input> 
</div>
</div>
</div>
</form>
</body>
</html>