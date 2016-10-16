<html>
<head><title>movie recommender system</title></head>
<form action="re2.php", method="post">
<link rel="stylesheet" href="div.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<body>

<div class="rs">
<?php
//include "fuu_adduserpro.php";
include "function_adduserpro.php";
session_start();
$id=$_SESSION["a"];
$link=mysqli_connect('localhost','root','','movie');
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_general_ci'");
//add_user_pro($link,$id)or die("fia");
add_user_pro($id,$link);
echo "您希望以哪種屬性作為推薦依據?"."<br>";
echo "----------------------------------------<br>";
echo " 1.導演<br>";
echo " 2.編劇<br>";
echo " 3.演員<br>";
echo "----------------------------------------<br>";
echo " 請選擇:<br>";
?>

<div class="cho">
<select name="cho">
  <option value="1" select="True">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  </select>

  <input type="submit" value="確定" name="ch">
</div> 
 </div>
 </body>
 </form>
 </html>