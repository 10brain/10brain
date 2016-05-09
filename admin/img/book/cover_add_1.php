<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>表紙登録</title>
</head>
<body>
<p>
<?php
if (isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error'])) {
    $ActType = $_POST['ActionType'];
    $Key0 = $_POST['KEYWORD0'];
    $Key1 = $_POST['KEYWORD1'];
    $Key2 = $_POST['KEYWORD2'];
    $Key3 = $_POST['KEYWORD3'];
    $Key20 = $_POST['KEYWORD20'];
    $Key21 = $_POST['KEYWORD21'];
    $Key22 = $_POST['KEYWORD22'];

    try {
        // $_FILES['upfile']['error'] の値を確認
        switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK: // OK
                break;
            case UPLOAD_ERR_NO_FILE:   // ファイル未選択
                throw new RuntimeException('ファイルが選択されていません');
            case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
            case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
                throw new RuntimeException('ファイルサイズが大きすぎます');
            default:
                throw new RuntimeException('その他のエラーが発生しました');
        }

        // $_FILES['upfile']['mime']の値はブラウザ側で偽装可能なので、MIMEタイプを自前でチェックする
        $type = @exif_imagetype($_FILES['upfile']['tmp_name']);
        /*if($type = )*/
        
        if (!in_array($type, [IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
            throw new RuntimeException('画像形式が未対応です');
        }else{
        // ファイルデータからSHA-1ハッシュを取ってファイル名を決定し、ファイルを保存する
            $tmp_file = @$_FILES['upfile']['tmp_name'];
            $ext = pathinfo($_FILES['upfile']['name'], PATHINFO_EXTENSION);
        }
            //list($file_name,$file_type) = explode(".",$_FILES['upfile']['name']);
            $dateformat=date("Ymd");
            $uploadfile = $dateformat.$Key20.".".$ext;
            $dir = '../book_add/tmp_cover/';
        if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $dir.$uploadfile)) {
            chmod($dir.$uploadfile, 0644);
            echo $uploadfile."をアップロードしました。";
            
            
            
        }else{    
            
            throw new RuntimeException('ファイル保存時にエラーが発生しました');
        }


        $msg = ['green', 'ファイルは正常にアップロードされました'];

    } catch (RuntimeException $e) {

        $msg = ['red', $e->getMessage()];

    }

}
echo $Key0;
if(!isset($Key22)){
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
        $tmp_dir = "../book_add/tmp_cover/".$uploadfile;
        echo $tmp_dir;
        $tmp_dir = file_get_contents($tmp_dir);
        //echo $tmp_dir;
        $_FILES['upfile']['type'];
        // INSERT処理
        $stmt = $pdo->prepare('INSERT INTO cover(ISBN,coverName,coverMime) VALUES(:isbn, :key1, :key2)');
        $stmt->bindParam(':isbn', $Key20, PDO::PARAM_STR);
        $stmt->bindParam(':key1', $uploadfile, PDO::PARAM_STR);
        $stmt->bindParam(':key2', $_FILES['upfile']['type'], PDO::PARAM_STR);


        $stmt->execute();//実行
        if(!$stmt){
            //システムエラー
            
        }

        $msgs[] = ['green', 'ファイルは正常にアップロードされました'];

    } catch (RuntimeException $e) {
        echo $e;
        while (ob_get_level()) {
            ob_end_clean(); // バッファをクリア
        }
        http_response_code($e instanceof PDOException ? 500 : $e->getCode());
        $msgs[] = ['red', $e->getMessage()];

    }
}else{
try {
    $type0= $_FILES['upfile']['type'];
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
        $tmp_dir = "../book_add/tmp_cover/".$uploadfile;
        echo $tmp_dir;
        $tmp_dir = file_get_contents($tmp_dir);
        //echo $tmp_dir;
        // INSERT処理
        $stmt = $pdo->prepare('UPDATE cover SET coverName=:key1, coverMime=:key2 WHERE ISBN=:isbn');
        $stmt->bindParam(':key1', $uploadfile, PDO::PARAM_STR);
        $stmt->bindParam(':key2', $type0, PDO::PARAM_STR);
        $stmt->bindParam(':isbn', $Key20, PDO::PARAM_STR);

        $stmt->execute();//実行     
    } catch (RuntimeException $e) {
        echo $e;
        while (ob_get_level()) {
            ob_end_clean(); // バッファをクリア
        }
        http_response_code($e instanceof PDOException ? 500 : $e->getCode());
        $msgs[] = ['red', $e->getMessage()];

    }

    
}
?></p><?=$test;?>
</body>
</html>
