<?php
function add_user_pro($id,$link)
{
	$sql="SELECT * FROM user WHERE user_id='".$id."'";
	$result=mysqli_query($link,$sql);
	$d_con=0;
	$e_con=0;
	$s_con=0;
	$sumd=0;
	$sume=0;
	$sums=0;
    while($record=mysqli_fetch_assoc($result))
    {
    	$m=$record['user_movie'];
        if($m!='')
        {
    	$sql2="SELECT * FROM movie_n WHERE movie_name='".$m."'";
	    $result2=mysqli_query($link,$sql2);
	    while($record2=mysqli_fetch_assoc($result2))
        {
        	if($record2['movie_name']==$m)
        	{
        		$d_con=$record2['d'];
        		$e_con=$record2['e'];
        		$s_con=$record2['s'];
        	}

        }
        $sumd+=$d_con;
        $sume+=$e_con;
        $sums+=$s_con;
        }
    }
    $sqld="UPDATE user_rd SET sum_d='$sumd' WHERE user_id='$id'";
    mysqli_query($link,$sqld);
    $sqle="UPDATE user_rd SET sum_ed='$sume' WHERE user_id='$id'";
    mysqli_query($link,$sqle);
    $sqls="UPDATE user_rd SET sum_sta='$sums' WHERE user_id='$id'";
    
    mysqli_query($link,$sqls);
    $line=$sumd."|".$sume."|".$sums."|";
    $sqlline="UPDATE user_rd SET user_line ='$line' WHERE user_id='$id'";
    mysqli_query($link,$sqlline);
}
?>