<?php
$link=mysqli_connect('localhost','root','','movie');
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_general_ci'");

$e_con=0;
$sql="SELECT movie_name FROM movie_editing";
$result=mysqli_query($link,$sql);

while($record=mysqli_fetch_assoc($result))
{
	$m=$record['movie_name'];
    $sql2="SELECT * FROM movie_n WHERE movie_name='".$m."'";
    $r2=mysqli_query($link,$sql2);
    while($record2=mysqli_fetch_assoc($r2))
    {
    	if($m==$record2['movie_name'])
        {
        $e_con=$record2['e'];
    	$e_con++;
        }
    }
$sqlup="UPDATE movie_n SET e='$e_con' WHERE movie_name='$m'";
mysqli_query($link,$sqlup);

}




?>