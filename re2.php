<html>
<head><title>movie recommender system</title>
<body>
<link rel="stylesheet" href="div.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<form action="end.php", method="post">
<div class="div0">
<?php
include "fu_dir.php";
include "fu_ed.php";
include "fu_sta.php";
include "fu_chocon.php";
include "fu_cos.php";
session_start();
$id=$_SESSION["a"];
$link=mysqli_connect('localhost','root','','movie');
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_general_ci'");
if(isset($_POST['ch']))
{
 $ch=$_POST['cho'];
 chocon($ch,$link);
 echo '<div class="rstop">';
 echo $id."推薦結果如下，請選擇推薦的滿意度並排名，以5分(星)等級來進行評分。";
 echo '</div>';

 //-------------------------dir rsmovie-----------
 $dir=ca_mov_dir($link,$id);
 $dir_list=explode("|",$dir);
 $movie=ca_same_dir_mov($dir_list,$link,$id);
 $movie_list=explode("|",$movie);
 $rsmovie_dir=ca_rsmovie_dir($movie_list,$link,$id);
 
 //-------------------------ed rsmovie-----------
 $ed=ca_mov_ed($link,$id);
 $ed_list=explode("|",$ed);
 $edmovie=ca_same_ed_mov($ed_list,$link,$id);
 $edmovie_list=explode("|",$edmovie);
 $rsmovie_ed=ca_rsmovie_ed($edmovie_list,$link,$id);
 //-------------------------sta rsmovie-----------
 $sta=ca_mov_sta($link,$id);
 $sta_list=explode("|",$sta);
 $stamovie=ca_same_sta_mov($sta_list,$link,$id);
 $stamovie_list=explode("|",$stamovie);
 $rsmovie_sta=ca_rsmovie_sta($stamovie_list,$link,$id);
 //--------------------------addmovie----------------------
 $addmovie=$rsmovie_dir+$rsmovie_ed+$rsmovie_sta;
 $addmovie=array_unique($addmovie);
 //print_r($addmovie);
 //------------------------將有關聯的電影都加入movie_rs----------------------------------
 foreach($addmovie as $value)
    {
    	$sql="INSERT INTO movie_rs(user_id,rs_movie) VALUES ('".$id."','".$value."')";
	     mysqli_query($link,$sql);

    }
 //-------------------------------加入各屬性值-------------------------------------------------------
add_dvalue($movie_list,$link,$id);
add_evalue($edmovie_list,$link,$id);
add_stavalue($stamovie_list,$link,$id);
//--------------------------------------計算sum vlaue------------------------------------
 $sum=0;
 $sql="SELECT * FROM movie_rs WHERE user_id='".$id."'";
 $result=mysqli_query($link,$sql);
 while($record=mysqli_fetch_assoc($result))
  {
    $m=$record['rs_movie'];
    $sum=$record['d_value']+$record['e_value']+$record['s_value'];
    $sqlsum="UPDATE movie_rs SET sum_value='$sum' WHERE rs_movie='$m'";
    mysqli_query($link,$sqlsum) ;
  }
 //--------------------------------計算cos值與排序結果--------------------------------------
get_cos($link,$id);
echo "<div class=rs1>";
order_cos($link,$id);
echo "</div>";
echo "<div class=rs2>";
echo "</div>";
echo "<div class=rs3>";
echo "</div>";
}
?>
<div class="star1">
<?php echo"list1評分:"?>
<select name="l1">
<option value="1" selected="True">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
</div>

<div class="ra">
<select name="rank1">
<option value="list1">list1</option>
<option value="list2">list2</option>
<option value="list3">list3</option>
</select>
<?php echo "<br>";?>
<?php echo "<br>";?>
<select name="rank2">
<option value="list1">list1</option>
<option value="list2">list2</option>
<option value="list3">list3</option>
</select>
<?php echo "<br>";?>
<?php echo "<br>";?>
<select name="rank3">
<option value="list1">list1</option>
<option value="list2">list2</option>
<option value="list3">list3</option>
</select>
</div>

<div class="staed">
<input type="submit" value="送出" name="sum">
</div>

</div>
</form>
</body>
</head>
</html>