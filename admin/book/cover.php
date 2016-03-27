<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
<body>
<?php
$cover_add = 'cover_add.php';
$isbn = $_POST['KEYWORD24'];//本来はここにISBN値をもってくる
?>
<form action="<?=$cover_add;?>" method="post" enctype="multipart/form-data">
  ファイル：<br />
  <input type="file" name="upfile" size="30" /><br />
  <br />
  <input type="hidden" name="KEYWORD24" value="<?=$isbn;?>">
  <input type="submit" value="アップロード" />

</form>
</body>
</html>
