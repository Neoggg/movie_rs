<html>
<head><title>catchmovie</title></head>
<body>
<?php
$link=@mysqli_connect('localhost','root','','movie');
mysqli_query($link,'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection='utf8_general_ci'");
$url='https://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=SELECT+DISTINCT+%3Fmovie_name%7B%0D%0A%3Fx+rdf%3Atype+dbo%3AFilm.%0D%0A%3Fx+rdfs%3Alabel+%3Fmovie_name.%0D%0A%0D%0AFILTER+langMatches%28lang%28%3Fmovie_name%29%2C%22zh%22%29.%0D%0A%7D&format=text%2Fhtml&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on';
$contents=file($url);
$s='';
for($i=0;$i<sizeof($contents);$i++)
{
  $n=strripos($contents[$i],'<pre>');
  if($n>0)
  {
  $n2=strripos($contents[$i],'</pre>');
  $h=substr($contents[$i],$n,$n2);
  $h=trim($h);
  $h=str_replace(array('"','@zh','<pre>','</pre>','</'),'',$h);
  //echo $h;
  $s=$s."|".$h;
  
  }
   

}
$e=explode("|",$s);
//print_r($e);
for($i=0;$i<sizeof($e);$i++)
{
	$sql="INSERT INTO movie_n(movie_name) VALUES('$e[$i]')";
	mysqli_query($link,$sql);
}
?>
</body>
</html>
