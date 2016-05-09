<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
<body>
<p>
<?php
if(isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error'])) {

if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
  if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "tmp_cover/" . $_FILES["upfile"]["name"])) {
    chmod("tmp_cover/" . $_FILES["upfile"]["name"], 0644);
    echo $_FILES["upfile"]["name"] . "をアップロードしました。";


  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}

try {

    // データベースに接続
    $pdo = new PDO(
        'mysql:host=localhost;dbname=10brain;charset=utf8',
        'root',
        'root',
        [
          PDO::ATTR_EMULATE_PREPARES => false,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
        //初期値設定
        $result = 0;
        $tmp_dir = "./tmp_cover/".$_FILES["upfile"]["name"];
        $tmp_dir = file_get_contents($tmp_dir);
        echo $tmp_dir;
        //echo $tmp_dir;
        //echo $_FILES['upfile']['type'];
        // INSERT処理
        $stmt = $pdo->prepare('INSERT INTO cover(ISBN,coverName,coverMime,coverTyp) VALUES(:isbn, :key1, :key2, :key3)');
        $stmt->bindParam(':isbn', $_POST['KEYWORD63'], PDO::PARAM_STR);
        $stmt->bindParam(':key1', $_FILES['upfile']['name'], PDO::PARAM_STR);
        $stmt->bindParam(':key2', $_FILES['upfile']['type'], PDO::PARAM_STR);
        $stmt->bindParam(':key3', $tmp_dir, PDO::PARAM_STR);


        $stmt->execute();//実行
        if(!$stmt){
            //システムエラー
            echo 'なんでできないの？';
        }

        $msgs[] = ['green', 'ファイルは正常にアップロードされました'];

    } catch (RuntimeException $e) {

        while (ob_get_level()) {
            ob_end_clean(); // バッファをクリア
        }
        http_response_code($e instanceof PDOException ? 500 : $e->getCode());
        $msgs[] = ['red', $e->getMessage()];

    }
}
?>
</p><?=$test;?>
</body>
</html>
