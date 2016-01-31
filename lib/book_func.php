<?php
require 'init.php';
//*****************************************************************************/
//
// 書籍情報SQL関連ファイル
// 20160119@ito
//
//*****************************************************************************/
class BookModel{

    /*********書籍一覧SQL*******************************************************/
    function GETBookList($ActType, $Key21, $Key22, $Key23, &$dspBookList){
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
            echo $Key2.'確認';
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
                while($array = $stmh->fetch(PDO::FETCH_ASSOC)){
                   $dspBookList[0] = $array['BookNum'];//書籍番号
                   $dspBookList[1] = $array['title'];//書籍タイトル
                   $dspBookList[2] = $array['remarks'];//出版社
                   $dspBookList[3] = $array['genre'];//ジャンル
                   $dspBookList[4] = $array['stock'];//在庫数
                }
           }
           
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }
    
    /*********書籍詳細SQL*************************************************/
    function GETBookDetail($ActType, $Key20, &$dspBookDet){
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
            $strSQL = $strSQL. " And BookNum IS NULL";
        }else{
            $strSQL = $strSQL. " And BookNum = :Key20 ";            
        }

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key20', $Key20, PDO::PARAM_INT);

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
                   //表示データ収集
                   $dspBookDet[0] = $array['title'];//書籍タイトル
                   $dspBookDet[1] = $array['jenre'];//ジャンル
                   $dspBookDet[2] = $array['pub'];//出版社
                   $dspBookDet[3] = $array['writer'];//著者
                   $dspBookDet[4] = $array['intro'];//紹介文
                   $dspBookDet[5] = $array['year'];//出版年
                   $dspBookDet[6] = $array['amazon'];//リンク
                   $dspBookDet[7] = $array['remarks'];//備考
                   $dspBookDet[8] = $array['cover'];//表紙名
               }

           }
           
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }

    
    /**************書籍登録SQL*************************************************/
    function GETBookAdd($ActType, $Key1, $Key24, $Key25, $Key26, $Key27, $Key28, $Key29, $Key30, $Key31, $Key32){
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
            $strSQL = "INSERT INTO Book(`BookNum`, `title`, `amazon`, `remarks`, `pub`, `writer`, `intro`, `year`, `genre`, `cover`,) VALUES";
            $strSQL = $strSQL. " (NULL, :Key24, :Key25, :Key26, :Key27, :Key28, :Key29, :Key30, :Key31, :Key32)";
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

            echo $Key2.'確認';
            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;

           
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }



}


?>