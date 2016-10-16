<?php
$link=mysqli_connect('localhost','root','','movie');
mysqli_query($link,'SET CHARACTER SET utf8' );
mysqli_query($link,"SET collation_connection='utf8_general_ci'");
$url="https://dbpedia.org/sparql?default-graph-uri=http%3A%2F%2Fdbpedia.org&query=select+distinct+%3Fmovie_name+%3Fediting+where%7B%0D%0A%3Fx+rdf%3Atype+dbo%3AFilm.%0D%0A%3Fx+rdfs%3Alabel+%3Fmovie_name.%0D%0A%3Fx+dbp%3Aediting+%3Fa.%0D%0A%3Fa+rdfs%3Alabel+%3Fediting.%0D%0A%0D%0AFILTER+langMatches%28lang%28%3Fmovie_name%29%2C%22zh%22%29.%0D%0AFILTER+langMatches%28lang%28%3Fediting%29%2C%22en%22%29.%0D%0A%7D&format=text%2Fhtml&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=30000&debug=on";
$contents=file($url);
$s='';
$s2='';
for($i=0;$i<sizeof($contents);$i++)
{
	$n=strripos($contents[$i],'<pre>');
	if($n>0&&$i%2==0)
	{
		$n2=strripos($contents[$i],'</pre>');
		$h=substr($contents[$i],$n,$n2);
		$h=trim($h);
		$h=str_replace(array('"','@zh','<pre>','</pre>','</'),'',$h);
		//echo $h;
		$s=$s.'|'.$h;
	}
	else if($n>0&&$i%2==1)
	{
		$n2=strripos($contents[$i],'</pre>');
		$h2=substr($contents[$i],$n,$n2);
		$h2=trim($h2);
		$h2=str_replace(array('"','@en','<pre>','</pre>','</'),'',$h2);
		//echo $h2;
		$s2=$s2.'|'.$h2;
	}
}
$e=explode('|',$s);
$e2=explode('|',$s2);
for($i=0;$i<sizeof($e);$i++)
{
	$sql="INSERT INTO movie_editing(movie_name,movie_ed) VALUES ('$e[$i]','$e2[$i]')";
	mysqli_query($link,$sql);
}
?>