<?php
function get_cos($link,$id)
{
	$sql="SELECT * FROM user_rd WHERE user_id='".$id."'";
	$result=mysqli_query($link,$sql);
	$record=mysqli_fetch_assoc($result);
	$user_d=$record['sum_d'];
	$user_e=$record['sum_ed'];
	$user_s=$record['sum_sta'];
	$aver=($user_d+$user_e)/2;
	$aver=$user_s/$aver;

	$sql2="SELECT * FROM movie_rs WHERE user_id='".$id."'";
	$result2=mysqli_query($link,$sql2);
	while($record2=mysqli_fetch_assoc($result2))
	{
		$m=$record2['rs_movie'];
		$d=$record2['d_value'];
		$e=$record2['e_value'];
		$s=$record2['s_value'];
		$nab=($d*$user_d)+($e*$user_e)+($s*$user_s)/$aver;
		$na=($d*$d)+($e*$e)+($s*$s);
		$na=Sqrt($na);
		$nb=($user_d*$user_d)+($user_e*$user_e)+($user_s*$user_s);
		$nb=Sqrt($nb);
		$cos=$nab/($na*$nb);
		//echo $cos;
		$sqlcos="UPDATE movie_rs SET cos_value='$cos' WHERE rs_movie='$m' AND user_id='$id'";
		mysqli_query($link,$sqlcos);
	}
}

function order_cos($link,$id)
{
	$sql="SELECT * FROM movie_rs WHERE user_id='".$id."' ORDER BY cos_value DESC";
	$result=mysqli_query($link,$sql);
	for($i=0;$i<10;$i++)
	{
		$record=mysqli_fetch_assoc($result);
		$s=$record['rs_movie'];
		echo ($i+1).".".$s."<br>";
	}
}
?>