<?php
function ca_mov_dir($link,$id)
{
	$dir_string='';
	$sql="SELECT * FROM user WHERE user_id='".$id."'";
	$result=mysqli_query($link,$sql);
	while($record=mysqli_fetch_assoc($result))
	{
       $user_movie=$record['user_movie'];
       $sql2="SELECT * FROM movie_director WHERE movie_name='".$user_movie."'";
       $result2=mysqli_query($link,$sql2);
       while($record2=mysqli_fetch_assoc($result2))
       {
       	$dir=$record2['movie_dir'];
       	$dir_string=$dir_string."|".$dir;
       }

	}
	return $dir_string;
}

function ca_same_dir_mov($dir_list,$link,$id)
{
  $movie_string="";

  foreach($dir_list as $value)
  {
  	if($value!='')
  	{
  		$sql="SELECT * FROM movie_director WHERE movie_dir='".$value."'";
  		$result=mysqli_query($link,$sql);
  		while($record=mysqli_fetch_assoc($result))
  		{
  			$m=$record['movie_name'];
  			$movie_string=$movie_string."|".$m;
  		}
  	}
  }
  return $movie_string;

}

function ca_rsmovie_dir($movie_list,$link,$id)
{
    foreach($movie_list as $key=>$value)
    {
    	$sql="SELECT * FROM user WHERE user_id='".$id."'";
	    $result=mysqli_query($link,$sql);
        while($record=mysqli_fetch_assoc($result))
        {
	     $m=$record['user_movie'];
	     if($m==$value)
	     {
	     	unset($movie_list[$key]);
	     }
        
        }
    }
    $rsm=array_unique($movie_list);
    return $rsm;
}

function add_dvalue($movie_list,$link,$id)
{
  $v=0;
  foreach($movie_list as $value)
  {
    $sql="SELECT * FROM movie_rs WHERE rs_movie='".$value."'";
    $result=mysqli_query($link,$sql);
    while($record=mysqli_fetch_assoc($result))
    {
      if($record['rs_movie']==$value)
      {
        $v=$record['d_value'];
        $v++;
      }
    }
    $sql2="UPDATE movie_rs SET d_value='$v' WHERE rs_movie ='$value'";
    mysqli_query($link,$sql2);
  }
}

?>