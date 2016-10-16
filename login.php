<html>
<head><title>login</title></head>
<link rel="stylesheet" href="div.css" type="text/css">
<body>
<div class="div0">
<meta http-equiv="Content-Type" content="text/html; charest=utf8">
 <div class="log2">
 <?php
    session_start();
    $link=mysqli_connect('localhost','root','','movie');
    mysqli_query($link,'SET CHARACTER SET utf8' );
    mysqli_query($link,"SET collation_connection='utf8_general_ci'");
    $id=$_POST["id"];
    //echo $_POST["id"];
    if($id=='')
    {
    	header("refresh:2;url=log.php");
    	echo "帳號不可為空!";
    }
    $sql2="SELECT * FROM user WHERE user_id ='".$id."'";
    $result=mysqli_query($link,$sql2) or die('dieee');
    $re=mysqli_num_rows($result);
    
    if($re>0&&$id!='')
    {
    	header("refresh:2;url=index.php");
    	$_SESSION["a"]=$_POST["id"];
    	echo "成員".$id."登入成功";
    }

    else if($re==0&&$id!='')
    {
    	header("refresh:2;url=index.php");
    	$sql="INSERT INTO user(user_id,user_movie) VALUES('".$_POST['id']."','')";
    	mysqli_query($link, $sql);
    	$sql2="INSERT INTO user_rd(user_id) VALUES ('".$_POST["id"]."')";
        mysqli_query($link, $sql2)or die('fail');
    	$_SESSION["a"]=$_POST["id"];
    	echo "成員".$id."註冊成功";
    }

?>
</div>
</div>
</body>
</html>
