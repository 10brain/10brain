<?php
require 'init.php';
//*****************************************************************************/
//
// 書籍情報SQL関連ファイル
// 20160119@ito
//
//*****************************************************************************/
class BookModel{
    /*********新着書籍一覧SQL*******************************************************/
    function GETBookNewList($ActType, &$dspBookNewList){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From Book Borrow INNER JOIN cover ON cover.ISBN = Book.ISBN";
        }
        //echo $Key21;

        $strSQL = $strSQL." ORDER BY date DESC LIMIT 30";


        //SQL実行
        try {
           //クラス呼び出し
           //$class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
            //$stmh->bindParam(':Key21', $Key21, PDO::PARAM_STR);

            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;

           $count=$stmh->rowCount();//実行結果の行数をカウント
           if($count == 0){
               //データなし
               $result = 0;
               echo $count;
           }else{
                //表示データ収集
               $i=0;
                while($array = $stmh->fetch(PDO::FETCH_ASSOC)){
                   $dspBookNewList[$i][0] = $array['BookNum'];//書籍番号
                   $dspBookNewList[$i][1] = $array['ISBN'];//ISBN
                   $dspBookNewList[$i][2] = $array['coverName'];//ISBN

                $i=$i+1;
                }
                //print_r($dspBookList);
           }

        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }

    /*********書籍一覧SQL*******************************************************/
    function GETBookList($ActType, $Key21, $Key22, &$dspBookList){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From Book";
        }
        echo $Key21;



   if ($Key21) {
       //$strSQL = $strSQL." Where title like :Key21";
            /*foreach ($Key21 as $keyword) {
                // プレースホルダのLIKE部分を用意
                $holders[] = "((title LIKE $keyword ESCAPE '!') OR (genre LIKE $keyword ESCAPE '!'))";
                // LIKE検索のために「%キーワード%」の形式にする
                $values[] = $values[] = '%' . preg_replace('/(?=[!_%])/', '!', $keyword) . '%';
            }
            // or条件で結合する
            if($Key22=="1"){
            $strSQL = $strSQL. ' WHERE (' . implode(' OR ', $holders) . ')';
            }else{
            // 実行
            $strSQL = $strSQL. ' WHERE (' . implode(' AND ', $holders) . ')';
            }*/

   }

        //入力フォームに値が入っているか確認
        /*
        if(!is_null($Key20)){
            $strSQL = $strSQL. " Where ";
        }
        */

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
            //$stmh->bindParam(':Key21', $Key21, PDO::PARAM_STR);

            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;

           $count=$stmh->rowCount();//実行結果の行数をカウント
           if($count == 0){
               //データなし
               $result = 0;
               echo $count;
           }else{
                //表示データ収集
               $i=0;
                while($array = $stmh->fetch(PDO::FETCH_ASSOC)){
                   $dspBookList[$i][0] = $array['BookNum'];//書籍番号
                   $dspBookList[$i][1] = $array['title'];//書籍タイトル
                   $dspBookList[$i][2] = $array['pub'];//出版社
                   $dspBookList[$i][3] = $array['genre'];//ジャンル
                   $dspBookList[$i][4] = $array['stock'];//在庫数
                   $dspBookList[$i][5] = $array['ISBN'];//ISBN
                   $dspBookList[$i][6] = $array['coverName'].$array['coverTyp'].$array['coverRaw'];
                $i=$i+1;
                }
                //print_r($dspBookList);
           }

        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }

    /*********管理者書籍検索SQL*************************************************/
    function GETAdminBook($ActType, $Key21, &$dspAdminBook){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From Book";
        }
        echo 'アクションタイプ確認ok';

        //書籍番号確認
        if($Key21){
            $strSQL = $strSQL. ' WHERE title Like :Key21';
        }
        $Key21 = "%$Key21%";
        echo $Key21;
        echo $result;
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key21', $Key21, PDO::PARAM_STR);


           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
          echo $strSQL;
           echo 'DB接続ok';
           echo $result;

           $count=$stmh->rowCount();//実行結果の行数をカウント
           if($count == 0){
               //データなし
               $result = 0;
               echo $count;
           }else{
                //表示データ収集
               $i=0;
                while($array = $stmh->fetch(PDO::FETCH_ASSOC)){
                   //表示データ収集
                   $dspAdminBook[$i][0] = $array['BookNum'];//書籍番号
                   $dspAdminBook[$i][1] = $array['title'];//書籍タイトル
                   $dspAdminBook[$i][2] = $array['genre'];//ジャンル
                   $dspAdminBook[$i][3] = $array['pub'];//出版社
                   $dspAdminBook[$i][4] = $array['stock'];//在庫数
                   $dspAdminBook[$i][5] = $array['cover'];
                   $dspAdminBook[$i][6] = $array['ISBN'];//ISBN
                  $i=$i+1;
               }

           }

        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }

    /*********書籍詳細SQL*************************************************/
    function GETBookDetail($ActType, $Key20, $Key21, &$dspBookDet){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From Book";
        }
        echo 'アクションタイプ確認ok';

        //書籍番号確認
        if(is_null($Key20) == True){
            $strSQL = $strSQL. " Where BookNum IS NULL";
        }else{
            $strSQL = $strSQL. " Where BookNum = :Key20";
        }

        //書籍番号確認
        if(is_null($Key21) == True){
            $strSQL = $strSQL. " And ISBN IS NULL";
        }else{
            $strSQL = $strSQL. " And ISBN = :Key21";
        }
        echo $result;
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           echo $strSQL;
            $stmh->bindParam(':Key20', $Key20, PDO::PARAM_STR);
            $stmh->bindParam(':Key21', $Key21, PDO::PARAM_STR);

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;

           $count=$stmh->rowCount();//実行結果の行数をカウント
           if($count == 0){
               //データなし
               $result = 0;
               echo $count;
           }else{
               //データ取得
               $array = $stmh->fetch(PDO::FETCH_ASSOC);
               if($array == false){
                   //システムエラー
                   $result = 2;
               }else{
                   //表示データ収集
                   $dspBookDet[0] = $array['title'];//書籍タイトル
                   $dspBookDet[1] = $array['genre'];//ジャンル
                   $dspBookDet[2] = $array['pub'];//出版社
                   $dspBookDet[3] = $array['writer'];//著者
                   $dspBookDet[4] = $array['intro'];//紹介文
                   $dspBookDet[5] = $array['year'];//出版年
                   $dspBookDet[6] = $array['amazon'];//リンク
                   $dspBookDet[7] = $array['remarks'];//備考
                   $dspBookDet[8] = $array['cover'];/*.$array['coverTyp'].$array['coverRaw'];*///表紙名
                   $dspBookDet[9] = $array['ISBN'];//ISBN
                   $dspBookDet[10] = $array['stock'];
                   $dspBookDet[11] = $array['BookNum'];

               }

           }

        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }


    /**************書籍登録SQL*************************************************/
    function GETBookAdd($ActType, $Key1, $Key24, $Key25, $Key26, $Key27, $Key28, $Key29, $Key30, $Key31, $Key32, $Key33){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }

        if($Key1 != 'admin@10baton.com'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "INSERT INTO Book(ISBN, title, genre, pub, writer, intro, year, amazon, remarks, date, stock) VALUES";
            $strSQL = $strSQL. "(:Key24, :Key25, :Key26, :Key27, :Key28, :Key29, :Key30, :Key31, :Key32, '" .Date('Ymd') ."', :stock)";
        }
        echo 'アクションタイプ確認ok';

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key24', $Key24, PDO::PARAM_STR);
           $stmh->bindParam(':Key25', $Key25, PDO::PARAM_STR);
           $stmh->bindParam(':Key26', $Key26, PDO::PARAM_STR);
           $stmh->bindParam(':Key27', $Key27, PDO::PARAM_STR);
           $stmh->bindParam(':Key28', $Key28, PDO::PARAM_STR);
           $stmh->bindParam(':Key29', $Key29, PDO::PARAM_STR);
           $stmh->bindParam(':Key30', $Key30, PDO::PARAM_STR);
           $stmh->bindParam(':Key31', $Key31, PDO::PARAM_STR);
           $stmh->bindParam(':Key32', $Key32, PDO::PARAM_STR);
           $stmh->bindValue(':stock', 1, PDO::PARAM_INT);


            //echo $Key2.'確認';
            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;


        } catch (Exception $Exception) {
            $result='4';
        }

        return $result;
    }

    /**************書籍表紙検索SQL*************************************************/
    function GETCoverSearch($ActType, $Key1, $Key60, &$dspCover){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }

        if($Key1 != 'admin@10baton.com'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From Book";
            $strSQL = $strSQL. "(:Key60)";
        }
        echo 'アクションタイプ確認ok';

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key60', $Key60, PDO::PARAM_STR);



            //echo $Key2.'確認';
            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;


        } catch (Exception $Exception) {
            $result='4';
        }

        return $result;
    }

    /**************書籍表紙登録SQL*************************************************/
    /*function GETBookCoverAdd($ActType, $Key1, $Key24, $Key25, $Key26, $Key27, $Key28, $Key29, $Key30, $Key31, $Key32, $Key33, $Key34, $Key35){
                // INSERT処理
        try{
                $stmt = $pdo->prepare('INSERT INTO image(name,type,raw_data,thumb_data,date) VALUES(?,?,?,?,?)');
                $stmt->execute([
                    $_FILES['upfile']['name'],
                    $info[2],
                    file_get_contents($_FILES['upfile']['tmp_name']),
                    ob_get_clean(), // バッファからデータを取得してクリア
                    (new DateTime('now', new DateTimeZone('Asia/Tokyo')))->format('Y-m-d H:i:s'),
                ]);

                $msgs[] = ['green', 'ファイルは正常にアップロードされました'];

            } catch (RuntimeException $e) {

                while (ob_get_level()) {
                    ob_end_clean(); // バッファをクリア
                }
                http_response_code($e instanceof PDOException ? 500 : $e->getCode());
                $msgs[] = ['red', $e->getMessage()];

            }

        /* ID指定があったとき *
        } elseif (isset($_GET['id'])) {

            try {

                $stmt = $pdo->prepare('SELECT type, raw_data FROM image WHERE id = ? LIMIT 1');
                $stmt->bindValue(1, $_GET['id'], PDO::PARAM_INT);
                $stmt->execute();
                if (!$row = $stmt->fetch()) {
                    throw new RuntimeException('該当する画像は存在しません', 404);
                }
                header('X-Content-Type-Options: nosniff');
                header('Content-Type: ' . image_type_to_mime_type($row['type']));
                echo $row['raw_data'];
                exit;

            } catch  (Exception $Exception){

                http_response_code($e instanceof PDOException ? 500 : $e->getCode());
                $msgs[] = ['red', $e->getMessage()];

            }

        }

        // サムネイル一覧取得
        $rows = $pdo->query('SELECT id,name,type,thumb_data,date FROM image ORDER BY date DESC')->fetchAll();

    } catch (PDOException $e) {

        http_response_code(500);
        $msgs[] = ['red', $e->getMessage()];

    }*/
     /**************貸出用書籍検索SQL*************************************************/
    function GETBorrowSearch($Key40, &$dspBorrowS){

        $strSQL = "Select * From Book";

        if(is_null($Key40)){
            $strSQL = $strSQL." Where BookNum Is NULL";
        }else{
            $strSQL = $strSQL." Where BookNum = :Key40";
        }

        $strSQL = $strSQL." And stock = 1";


        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key40', $Key40, PDO::PARAM_STR);

            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;
           $count=$stmh->rowCount();//実行結果の行数をカウント

           if($count == 0){
               //データなし
               $result = 1;
               echo $count;
           }else{
               //データ取得
               $array = $stmh->fetch(PDO::FETCH_ASSOC);
               print_r($array);
               if($array == false){
                   //システムエラー
                   $result = 2;
               }else{
                   $dspBorrowS[0] = $array['BookNum'];
                   $dspBorrowS[1] = $array['title'];
                   $dspBorrowS[3] = $array['stock'];

               }

           }


        } catch (Exception $Exception) {

        }
        //return $dspUserInfo;
        return $result;



    }



    /**************貸出登録SQL*************************************************/

    function GETBorrowAdd($ActType, $Key0, $Key40, $Key42){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }
        //貸出登録
        if(!is_null($Key40)){
            $strSQL = "INSERT INTO Borrow(BookNum, BDate, RePlan,  Num)";
            $strSQL = $strSQL. " VALUES(:Key40, '" .Date("Ymd") ."', :Key42, :Key0)";
        }

        echo 'アクションタイプ確認ok';

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key40', $Key40, PDO::PARAM_STR);
           $stmh->bindParam(':Key42', $Key42, PDO::PARAM_STR);
           $stmh->bindParam(':Key0', $Key0, PDO::PARAM_INT);


            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;


        } catch (Exception $Exception) {
            $result=4;
        }

        //return $dspUserInfo;
        return $result;
    }


     /**************貸出在庫数調整SQL*************************************************/
    function GETStock($ActType, $Key0, $Key40){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }
        //貸出登録
        //在庫処理sql

            $strSQL = "Update Book SET stock=";
            $strSQL =  $strSQL. " CASE WHEN stock IS NULL OR stock <= 0 THEN 0 ELSE stock - 1 END";
            $strSQL =  $strSQL. " Where BookNum = :Key40";


        echo '在庫数処理開始';
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key40', $Key40, PDO::PARAM_STR);


            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;


        } catch (Exception $Exception) {
            $result=5;
        }

        //return $dspUserInfo;
        return $result;
    }

    /*********貸出履歴（管理者）SQL***********************************************/
    function GETBorrowList($ActType, $Key1, &$dspBorrowList){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From";
        }
        $strSQL = $strSQL." Borrow INNER JOIN Book ON Borrow.BookNum = Book.BookNum INNER JOIN User ON Borrow.Num = User.Num";
        echo 'アクションタイプ確認ok';

        //管理者ID確認
        if($Key1 != 'admin@10baton.com'){
            $result = 2;
            return $result;
        }


        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           //$stmh->bindParam(':Key2', $Key2, PDO::PARAM_STR);
            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;

           $count=$stmh->rowCount();//実行結果の行数をカウント
           if($count == 0){
               //データなし
               $result = 0;
               echo $count;
           }else{
                //表示データ収集
                $i=0;
                while($array = $stmh->fetch(PDO::FETCH_ASSOC)){
                   $dspBorrowList[$i][0] = $array['BNum'];//貸出番号
                   $dspBorrowList[$i][1] = $array['BDate'];//貸出日
                   $dspBorrowList[$i][2] = $array['RePlan'];//返却予定日
                   $dspBorrowList[$i][3] = $array['ReDate'];//返却日
                   $dspBorrowList[$i][4] = $array['BookNum'];//書籍番号
                   $dspBorrowList[$i][5] = $array['Num'];//社員番号
                   $dspBorrowList[$i][6] = $array['Name'];//社員番号
                   $dspBorrowList[$i][7] = $array['title'];//社員番号
                 $i=$i+1;

                }
           }

        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }

    /*********貸出履歴（一般）SQL*********************************************/
    function GETBorrowUList($ActType, $Key0, &$dspBorrowUList){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From";
        }

            $strSQL = $strSQL." Borrow INNER JOIN Book ON Borrow.BookNum = Book.BookNum";
        echo 'アクションタイプ確認ok';

        //ID確認
        if(is_null($Key0) == True){
            $strSQL = $strSQL. " Where Num IS NULL";
        }else{
            $strSQL = $strSQL. " Where Num = :Key0 ";
        }
        $strSQL = $strSQL. " Order By BDate DESC";
        echo $Key1.'確認';


        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key0', $Key0, PDO::PARAM_STR);
            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;

           $count=$stmh->rowCount();//実行結果の行数をカウント
           if($count == 0){
               //データなし
               $result = 0;
               echo $count;
           }else{
                //表示データ収集
               $i=0;
                while($array = $stmh->fetch(PDO::FETCH_ASSOC)){
                   $dspBorrowUList[$i][0] = $array['BNum'];//貸出番号
                   $dspBorrowUList[$i][1] = $array['BDate'];//貸出日
                   $dspBorrowUList[$i][2] = $array['RePlan'];//返却予定日
                   $dspBorrowUList[$i][3] = $array['ReDate'];//返却日
                   $dspBorrowUList[$i][4] = $array['BookNum'];//書籍番号
                   $dspBorrowUList[$i][5] = $array['Num'];//社員番号
                   $dspBorrowUList[$i][6] = $array['title'];//書籍タイトル
                   $i=$i+1;
                }
                print_r($dspBorrowUList[0]);
                print_r($dspBorrowUList);
           }

        } catch (Exception $Exception) {
            $result=4;
        }
        //return $dspUserInfo;
        return $result;
    }

    /*********貸出履歴詳細SQL*********************************************/
    function GETBorrowU($ActType, $Key0, $Key40, &$dspBorrowU){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From";
        }

            $strSQL = $strSQL." Borrow INNER JOIN Book ON Borrow.BookNum = Book.BookNum";
        echo 'アクションタイプ確認ok';

        //ID確認
        if(is_null($Key0) == True){
            $strSQL = $strSQL. " Where Num IS NULL";
        }else{
            $strSQL = $strSQL. " Where Num = :Key0 ";
        }

        //貸出番号確認
        if(is_null($Key40) == True){
            $strSQL = $strSQL. " And BNum IS NULL";
        }else{
            $strSQL = $strSQL. " And BNum = :Key40";
        }
        echo $Key1.'確認';


        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key0', $Key0, PDO::PARAM_STR);
           $stmh->bindParam(':Key40', $Key40, PDO::PARAM_STR);
            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;

           $count=$stmh->rowCount();//実行結果の行数をカウント
           if($count == 0){
               //データなし
               $result = 0;
               echo $count;
           }else{
               //データ取得
               $array = $stmh->fetch(PDO::FETCH_ASSOC);
               if($array == false){
                   //システムエラー
                   $result = 2;
               }else{
                   $dspBorrowU[0] = $array['BookNum'];//書籍番号
                   $dspBorrowU[1] = $array['title'];//タイトル
                   $dspBorrowU[2] = $array['BDate'];//貸出び
                   $dspBorrowU[3] = $array['RePlan'];//返却日
                   $dspBorrowU[4] = $array['BNum'];//貸出番号
               }

           }

        } catch (Exception $Exception) {
            $result=4;
        }
        //return $dspUserInfo;
        return $result;
    }

    /*********返却処理SQL*********************************************/
    function GETReturnU($ActType, $Key0, $Key40){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
          $strSQL = "Update Borrow SET ReDate='" .Date('Ymd') ."'";
        }
        echo 'アクションタイプ確認ok';

        //貸出番号確認
        if(is_null($Key40) == True){
            $strSQL = $strSQL. " Where BNum IS NULL";
        }else{
            $strSQL =  $strSQL. " Where BNum = :Key40";
        }

        //社員番号確認
        if(is_null($Key0) == True){
            $strSQL = $strSQL. " And Num IS NULL";
        }else{
            $strSQL = $strSQL. " And Num = :Key0 ";
        }
        echo $Key1.'確認';


        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key0', $Key0, PDO::PARAM_STR);
           $stmh->bindParam(':Key40', $Key40, PDO::PARAM_STR);
            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;

        } catch (Exception $Exception) {
            $result=4;
        }
        //return $dspUserInfo;
        return $result;
    }

     /**************返却在庫数調整SQL*************************************************/
    function GETStockAdd($ActType, $Key20){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }
        //貸出登録
        //在庫処理sql

            $strSQL = "Update Book SET stock=";
            //$strSQL =  $strSQL. " CASE WHEN stock<2 THEN 1 ELSE stock +1 END";
            $strSQL =  $strSQL. " stock+1";
        //書籍番号確認
        if(is_null($Key20) == True){
            $strSQL = $strSQL. " And BookNum IS NULL";
        }else{
            $strSQL = $strSQL. " And BookNum = :Key20 ";
        }

        echo '在庫数処理開始';
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key20', $Key20, PDO::PARAM_STR);


            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;


        } catch (Exception $Exception) {
            $result=5;
        }

        //return $dspUserInfo;
        return $result;
    }



}


?>
