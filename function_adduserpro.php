<html>
<head>
	<title></title>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<body>
<?php
function add_user_pro($id,$link)
{
$sql2="SELECT * FROM user where user_id='".$id."'";
$result2=mysqli_query($link,$sql2); 
$dstring='';
$pstring='';
$edstring='';
$wristring='';
$musstring='';
$cinstring='';
$stastring='';
$collstring='';
while ($r = mysqli_fetch_array($result2)) {
    $m=$r['user_movie'];
    $d="SELECT * FROM movie_n where movie_name='".$m."'";
    $result=mysqli_query($link,$d);
    while ($r2 = mysqli_fetch_array($result))
     {
           $dn=$r2['d'];
           $pn=$r2['e'];
           $edn=$r2['s'];
           
           //echo $n; 
            //$sqlc="UPDATE user SET d='$n'  WHERE user_movie='$m',(where user_id='$str') ";
            //mysqli_query($link, $sqlc); 
           $dstring=$dstring."|".$dn; 
           $pstring=$pstring."|".$pn; 
           $edstring=$edstring."|".$edn; 
           
     }
}
$da=explode("|", $dstring);
$pa=explode("|", $pstring);
$eda=explode("|", $edstring);

$dsum=0;
$psum=0;
$edsum=0;

for($i=0;$i<sizeof($da);$i++)
{
       $dsum+=$da[$i];
       $psum+=$pa[$i];
       $edsum+=$eda[$i];
      
}
/*if($dsum==0)
{
  $dsum=1;
}
if($psum==0)
{
  $psum=1;
}
if($edsum==0)
{
  $edsum=1;
}
if($wrisum==0)
{
  $wrisum=1;
}
if($mussum==0)
{
  $mussum=1;
}
if($cinsum==0)
{
  $cinsum=1;
}
if($stasum==0)
{
  $stasum=1;
}
if($collsum==0)
{
  $collsum=1;
}
*/
$sqld="UPDATE user_rd SET sum_d='$dsum'  where user_id='$id' ";
mysqli_query($link, $sqld);
$sqlp="UPDATE user_rd SET sum_ed='$psum'  where user_id='$id' ";
mysqli_query($link, $sqlp);
$sqled="UPDATE user_rd SET sum_sta='$edsum'  where user_id='$id' ";
mysqli_query($link, $sqled);


$string='';
$string=$dsum."|".$psum."|".$edsum;
$line="UPDATE user_rd SET user_line='$string'  where user_id='$id' ";
mysqli_query($link, $line);
}
?>
</body>
</html>