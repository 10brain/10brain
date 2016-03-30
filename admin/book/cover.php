<?php
require '../lib/user_func.php';
require '../lib/check.php';

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";
$Key3 ="";

//IDとパスワードチェック
if (!isID($_POST["KEYWORD1"],40,1)){
    $result = 1;
}elseif (!isPW($_POST["KEYWORD2"],10,1)){
    $result = 1;
}else{
    $ActType = $_POST["ActionType"];
    $Key0 = $_POST["KEYWORD0"];  //社員番号
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];  //パスワード
    $Key3 = $_POST["KEYWORD3"];  //名前
}
$cover_add = 'cover_add.php';
$isbn = $_POST['KEYWORD24'];//本来はここにISBN値をもってくる
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
<body>
<form action="<?=$cover_add;?>" method="post" enctype="multipart/form-data">
  ファイル：<br />
  <input type="file" name="upfile" size="30" /><br />
  <br />
  <input type="hidden" name="ActionType" value="TgRSPInf">
  <input type="hidden" name="KEYWORD1" value="<?=$Key1;?>">
  <input type="hidden" name="KEYWORD2" value="<?=$Key2;?>">
  <input type="hidden" name="KEYWORD3" value="<?=$Key3;?>">
  <input type="hidden" name="KEYWORD24" value="<?=$isbn;?>">
  <input type="submit" value="アップロード" />

</form>
</body>
</html>
