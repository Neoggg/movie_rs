<?php
function ca_mov_ed($link,$id)
{
	$ed_string='';
	$sql="SELECT * FROM user WHERE user_id='".$id."'";
	$result=mysqli_query($link,$sql);
	while($record=mysqli_fetch_assoc($result))
	{
       $user_movie=$record['user_movie'];
       $sql2="SELECT * FROM movie_editing WHERE movie_name='".$user_movie."'";
       $result2=mysqli_query($link,$sql2);
       while($record2=mysqli_fetch_assoc($result2))
       {
       	$ed=$record2['movie_ed'];
       	$ed_string=$ed_string."|".$ed;
       }

	}
	return $ed_string;
}

function ca_same_ed_mov($ed_list,$link,$id)
{
  $edmovie_string="";

  foreach($ed_list as $value)
  {
  	if($value!='')
  	{
  		$sql="SELECT * FROM movie_editing WHERE movie_ed='".$value."'";
  		$result=mysqli_query($link,$sql);
  		while($record=mysqli_fetch_assoc($result))
  		{
  			$m=$record['movie_name'];
  			$edmovie_string=$edmovie_string."|".$m;
  		}
  	}
  }
  return $edmovie_string;

}

function ca_rsmovie_ed($edmovie_list,$link,$id)
{
    foreach($edmovie_list as $key=>$value)
    {
    	$sql="SELECT * FROM user WHERE user_id='".$id."'";
	    $result=mysqli_query($link,$sql);
        while($record=mysqli_fetch_assoc($result))
        {
	     $m=$record['user_movie'];
	     if($m==$value)
	     {
	     	unset($edmovie_list[$key]);
	     }
        
        }
    }
    $rsm=array_unique($edmovie_list);
    return $rsm;
}

function add_evalue($edmovie_list,$link,$id)
{
  $v=0;
  foreach($edmovie_list as $value)
  {
    $sql="SELECT * FROM movie_rs WHERE rs_movie='".$value."'";
    $result=mysqli_query($link,$sql);
    while($record=mysqli_fetch_assoc($result))
    {
      if($record['rs_movie']==$value)
      {
        $v=$record['e_value'];
        $v++;
      }
    }
    $sql2="UPDATE movie_rs SET e_value='$v' WHERE rs_movie ='$value'";
    mysqli_query($link,$sql2);
  }
}
?>