<html>
<head><titel>catchab</title></head>
<body>
<?php
$link=@mysqli_connect('localhost','root','','movie');
mysqli_query($link,'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection='utf8_general_ci'");
$url='https://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=SELECT+DISTINCT+%3Fmovie_name+%3Fabstract+WHERE+%7B%0D%0A%3Fx+rdf%3Atype+dbo%3AFilm.%0D%0A%3Fx+rdfs%3Alabel+%3Fmovie_name.%0D%0A%3Fx+dbo%3Aabstract+%3Fabstract.%0D%0A%0D%0AFILTER+langMatches%28lang%28%3Fmovie_name%29%2C+%22ZH%22%29.%0D%0AFILTER+langMatches%28lang%28%3Fabstract%29%2C+%22ZH%22%29.%0D%0A%7D&format=text%2Fhtml&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on';
$contents2=file($url);
$contents=file_get_contents($url);
$s='';
$s2='';
//print_r($content);
for($i=0;$i<sizeof($contents2);$i++)
{
   $n=strripos($contents2[$i],"<pre>");
   if($n>0&&$i%2==0)
   {
   	$n2=strripos($contents2[$i],"</pre>");
   	$h=substr($contents2[$i],$n,$n2);
   	$h=trim($h);
   	$h=str_replace(array('"','@zh','<pre>','</pre>','</'),'',$h);
   	//echo $h."<br>";
    $s=$s."|".$h;
   }

   else if($n>0&&$i%2==1)
   {
	$n2=strripos($contents2[$i],"</pre>");
   	$h2=substr($contents2[$i],$n,$n2);
   	$h2=trim($h2);
   	$h2=str_replace(array('"','@zh','<pre>','</pre>','</'),'',$h2);
   	//echo $h2."<br>";
   	$s2=$s2."|".$h2;
   }
}
$e=explode("|",$s);
$e2=explode("|",$s2);
//echo $s;
//echo $s2;
for($i=0;$i<sizeof($e);$i++)
{

    $sql="INSERT INTO movie_abstract(movie_name,movie_ab) VALUES('$e[$i]','$e2[$i]')";
    mysqli_query($link,$sql);
}


?>
</body>
</html>
