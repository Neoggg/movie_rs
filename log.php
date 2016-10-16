<html>
<head><title>login</title></head>
<body class="body">
<link rel="stylesheet" href="div.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charest=utf8">
<div class="div0">
<?php
session_start();
?>
<form action="login.php" method="post">
<div class="log">
<fieldset><legend>註冊/登入</legend>
帳號:<input type="text" name="id"/>
<input type="submit" name="insert" value="註冊/登入"/>

</div>
</form>
</div>
</body>
</html>