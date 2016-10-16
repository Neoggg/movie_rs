<?php
function chocon($ch,$link)
{
  $d=0;
  $e=0;
  $s=0;
  $sql="SELECT * FROM cho_con";
  $result=mysqli_query($link,$sql);
  $cho=mysqli_fetch_assoc($result);
  if($ch=='1')
  {
     $d=$cho['d_con'];
     $d++;
  
   $sqld="UPDATE cho_con SET d_con='$d'";
   mysqli_query($link,$sqld);
  }

  if($ch=='2')
  {
     $e=$cho['e_con'];
     $e++;
  
   $sqld="UPDATE cho_con SET e_con='$e'";
   mysqli_query($link,$sqld);
  }

  if($ch=='3')
  {
     $s=$cho['s_con'];
     $s++;
  
   $sqld="UPDATE cho_con SET s_con='$s'";
   mysqli_query($link,$sqld);
  }
 
  

}
?>