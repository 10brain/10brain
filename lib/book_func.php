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
        
        //テキストエリアに値が入っていたら

   if ($Key21) {
            foreach ($Key21 as $keyword) {
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
            }
  
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
            $stmh->bindParam(':Key21', $Key21, PDO::PARAM_STR);
 
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
                   $dspBookList[$i][2] = $array['remarks'];//出版社
                   $dspBookList[$i][3] = $array['genre'];//ジャンル
                   $dspBookList[$i][4] = $array['stok'];//在庫数
                $i=$i+1;
                }
                //print_r($dspBookList);
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
            $strSQL = $strSQL. " Where BookNum IS NULL";
        }else{
            $strSQL = $strSQL. " Where BookNum = :Key20";            
        }
echo $result;
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           echo $strSQL;
            $stmh->bindParam(':Key20', $Key20, PDO::PARAM_STR);

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
                   $dspBookDet[1] = $array['genre'];//ジャンル
                   $dspBookDet[2] = $array['pub'];//出版社
                   $dspBookDet[3] = $array['writer'];//著者
                   $dspBookDet[4] = $array['intro'];//紹介文
                   $dspBookDet[5] = $array['year'];//出版年
                   $dspBookDet[6] = $array['amazon'];//リンク
                   $dspBookDet[7] = $array['remarks'];//備考
                   $dspBookDet[8] = $array['cover'];//表紙名
               }
                print_r($dspBookDet);
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