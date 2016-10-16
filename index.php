<html>
<head><title>movie recommender system</title></head>
<body>
<form action="index.php" , method="post">
<link rel="stylesheet" href="div.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<div class="div0">
<div class="div1">
<?php
session_start();
echo $_SESSION["a"]."成員登入中...";
echo "<br>";
$id=$_SESSION["a"];
?>
搜尋電影:<input type="text" name="m" />
<input type="submit" name="search" value="GO"/>
</div>
<div class="div2">
<feildset><legend>movie</legend>
<?php
$link=mysqli_connect('localhost','root','','movie');
mysqli_query($link,'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection='utf8_general_ci'");
if(isset($_POST['m'])&&$_POST['m']!='')
{
	$sqlsear="SELECT * FROM movie_n WHERE movie_name like '%".$_POST['m']."%'";
	$result=mysqli_query($link,$sqlsear);
	$rows=mysqli_num_rows($result);

	if ($rows==0) {
		echo "查無此電影!!";
	}

	if($rows>0)
	{
		for($i=0;$i<$rows;$i++)
		{
			$record=mysqli_fetch_assoc($result);
			$movie[$i]=$record['movie_name'];
			//echo $movie[$i].'<br>';
			echo '<table border="1" rules="none" style="border:0px #cccccc solid;">';
			echo '<tr>';
			echo '<td>'.$movie[$i];
			echo '</td>';
			echo '<td>';
			echo '<input type="checkbox" name="add[]" value="'.$movie[$i].'">';
			echo '</td>';
			echo '</tr>';
			echo '</table>';
		}
		echo '----------------------------------------------------------------------------------------'.'<br>';
		echo '<input type="submit" name="addsum" value="加入清單"/>'.'<br>';
	}
}
$num=0;
$sum=0;
if(isset($_POST['addsum']))
{
  foreach($_POST['add'] as $value)
  {
  	$sqlcon="SELECT * FROM movie_n where movie_name = '".$value."'";
  	$result=mysqli_query($link,$sqlcon);
  	while($record=mysqli_fetch_array($result))
  	{
  		$counts=$record['counts'];
  		$counts++;
  	}
  	$sqlad="INSERT INTO user(user_id,user_movie) VALUES ('".$id."','".$value."')";
  	$sqlup="UPDATE movie_n SET counts='$counts' WHERE movie_name='$value'";
  	mysqli_query($link,$sqlad);
  	mysqli_query($link,$sqlup);
  	$num++;
  }
  echo "新增".$num."筆資料"."<br>";
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
  $sqlm="UPDATE user_rd SET counts='$sum' WHERE user_id='$id'";
  mysqli_query($link,$sqlm);
}

?>
</feildset>
</div>
<div class="div3">
<input type ="button" onclick="javascript:location.href='log.php'" value="回登入頁"></input> 
<input type="button" onclick="javascript:location.href='list.php'" value="電影清單"></input>
<input type ="button" onclick="javascript:location.href='re.php'" value="下一步"></input> 
</div>
</div>
</form>
</body>
</html>