<?php
$link=mysqli_connect('localhost','root','','movie');
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_general_ci'");

$s_con=0;
$sql="SELECT movie_name FROM movie_starring";
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
        $s_con=$record2['s'];
    	$s_con++;
        }
    }
$sqlup="UPDATE movie_n SET s='$s_con' WHERE movie_name='$m'";
mysqli_query($link,$sqlup);

}




?>