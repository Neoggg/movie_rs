<?php
function ca_mov_sta($link,$id)
{
	$sta_string='';
	$sql="SELECT * FROM user WHERE user_id='".$id."'";
	$result=mysqli_query($link,$sql);
	while($record=mysqli_fetch_assoc($result))
	{
       $user_movie=$record['user_movie'];
       $sql2="SELECT * FROM movie_starring WHERE movie_name='".$user_movie."'";
       $result2=mysqli_query($link,$sql2);
       while($record2=mysqli_fetch_assoc($result2))
       {
       	$sta=$record2['movie_sta'];
       	$sta_string=$sta_string."|".$sta;
       }

	}
	return $sta_string;
}

function ca_same_sta_mov($sta_list,$link,$id)
{
  $stamovie_string="";

  foreach($sta_list as $value)
  {
  	if($value!='')
  	{
  		$sql="SELECT * FROM movie_starring WHERE movie_sta='".$value."'";
  		$result=mysqli_query($link,$sql);
  		while($record=mysqli_fetch_assoc($result))
  		{
  			$m=$record['movie_name'];
  			$stamovie_string=$stamovie_string."|".$m;
  		}
  	}
  }
  return $stamovie_string;

}

function ca_rsmovie_sta($stamovie_list,$link,$id)
{
    foreach($stamovie_list as $key=>$value)
    {
    	$sql="SELECT * FROM user WHERE user_id='".$id."'";
	    $result=mysqli_query($link,$sql);
        while($record=mysqli_fetch_assoc($result))
        {
	     $m=$record['user_movie'];
	     if($m==$value)
	     {
	     	unset($stamovie_list[$key]);
	     }
        
        }
    }
    $rsm=array_unique($stamovie_list);
    return $rsm;
}

function add_stavalue($stamovie_list,$link,$id)
{
  $v=0;
  foreach($stamovie_list as $value)
  {
    $sql="SELECT * FROM movie_rs WHERE rs_movie='".$value."'";
    $result=mysqli_query($link,$sql);
    while($record=mysqli_fetch_assoc($result))
    {
      if($record['rs_movie']==$value)
      {
        $v=$record['s_value'];
        $v++;
      }
    }
    $sql2="UPDATE movie_rs SET s_value='$v' WHERE rs_movie ='$value'";
    mysqli_query($link,$sql2);
  }
}
?>