<?php
require 'init.php';
//*****************************************************************************/
//
// 貸出・返却・リクエストSQL関連ファイル
// 20160119@ito
//
//*****************************************************************************/
class otherModel{

    /*********貸出履歴（管理者）SQL***********************************************/
    function GETBorrowList($ActType, $Key1, $Key22, $Key23, &$dspBorrowList){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From Borrow";
        }
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
           $stmh->bindParam(':Key1', $Key1, PDO::PARAM_STR);

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
                   $dspBorrowList[0] = $array['BNum'];//貸出番号
                   $dspBorrowList[1] = $array['BDate'];//貸出日
                   $dspBorrowList[2] = $array['RePlan'];//返却予定日
                   $dspBorrowList[3] = $array['ReDate'];//返却日
                   $dspBorrowList[4] = $array['BookNum'];//書籍番号
                   $dspBorrowList[5] = $array['Num'];//社員番号

                }
           }
           
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }

        /*********貸出履歴（一般）SQL*********************************************/
    function GETBorrowUList($ActType, $Key1, &$dspBorrowUList){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From Borrow";
        }
        echo 'アクションタイプ確認ok';
        
        //ID確認
        if(is_null($Key1) == True){
            $strSQL = $strSQL. " Where Num IS NULL";
        }else{
            $strSQL = $strSQL. " Where Num = :Key1 ";            
        }
        echo $Key1.'確認';
       
        
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key1', $Key1, PDO::PARAM_STR);
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
                   $dspBorrowUList[0] = $array['BNum'];//貸出番号
                   $dspBorrowUList[1] = $array['BDate'];//貸出日
                   $dspBorrowUList[2] = $array['RePlan'];//返却予定日
                   $dspBorrowUList[3] = $array['ReDate'];//返却日
                   $dspBorrowUList[4] = $array['BookNum'];//書籍番号
                   $dspBorrowUList[5] = $array['Num'];//社員番号

                }
                print_r($dspBorrowUList);
           }
           
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }

    /*********リクエスト一覧SQL***************************************************/
    function GETRequest($ActType, $Key1, &$dspRequest){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }
        if(!is_null($Key1)){
            $strSQL = "Select * From Request";
        }else{
            $result = 2;
            return $result;    
        }
        echo 'アクションタイプ確認ok';
        /*
        //社員番号確認
        if(is_null($Key3) == True){
            $strSQL = $strSQL. " Where Num IS NULL";
        }else{
            $strSQL = $strSQL. " Where Num = :Key3";            
        }
        echo $Key1.'確認';
        */
       
        
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           //$stmh->bindParam(':Key3', $Key3, PDO::PARAM_INT);

            //echo $Key2.'確認';
            //echo $strSQL;

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
                   $dspRequest[i][0] = $array['ReqNum'];//リクエスト番号
                   $dspRequest[i][1] = $array['ReqTitle'];//リクエスト書籍タイトル
                   $dspRequest[i][2] = $array['ReqDate'];//リクエスト登録日
                   $dspRequest[i][3] = $array['app'];//承認び
                   $dspRequest[i][4] = $array['pur'];//購入
                   $dspRequest[i][5] = $array['Num'];//リクエスト者社員番号
                }
           }
           
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }

    /*********リクエスト詳細SQL*************************************************/
    function GETRequestDetail($ActType, $Key1, $Key40, &$dspRequestDet){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }
        
        if($Key1=='admin@10baton.com'){
            $strSQL = "Select * From Book";
        }else{
            $result = 2;
            return $result;
        }
        echo 'アクションタイプ確認ok';
        
        //書籍番号確認        
        if(is_null($Key40) == True){
            $strSQL = $strSQL. " Where ReqNum IS NULL";
        }else{
            $strSQL = $strSQL. " Where ReqNum = :Key40 ";            
        }

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key40', $Key40, PDO::PARAM_INT);

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
                   $dspRequestDet[0] = $array['ReqNum'];//リクエスト番号
                   $dspRequestDet[1] = $array['ReqTitle'];//リクエスト書籍名
                   $dspRequestDet[2] = $array['ReqAmaz'];//リクエスト書籍リンク
                   $dspRequestDet[3] = $array['ReqRem'];//リクエスト書籍備考
                   $dspRequestDet[4] = $array['ReqDate'];//リクエスト登録日
                   $dspRequestDet[5] = $array['app'];//承認
                   $dspRequestDet[6] = $array['pur'];//購入
                   $dspRequestDet[7] = $array['Num'];//社員番号
               }

           }
           
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }

    
    /**************リクエスト登録SQL*************************************************/
    function GETRequestAdd($ActType, $Key1, $Key41, $Key42, $Key43, $Key44){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "INSERT INTO Request(`ReqNum`, `Reqtitle`, `Reqamaz`, `ReqRem`, `ReqDate`) VALUES";
            $strSQL = $strSQL. " (NULL, :Key41, :Key42, :Key43, :Key44)";
        }
        echo 'アクションタイプ確認ok';
        
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key41', $Key41, PDO::PARAM_STR);
           $stmh->bindParam(':Key42', $Key42, PDO::PARAM_STR);
           $stmh->bindParam(':Key43', $Key43, PDO::PARAM_STR);
           $stmh->bindParam(':Key44', $Key44, PDO::PARAM_INT);

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
    /**************リクエスト承認SQL*************************************************/
    function GETRequestApp($ActType, $Key1, $Key45, $Key40){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }
        
        if($Key1=='admin@10baton.com'){
            $strSQL = "UPDATE Request SET app = :Key45";
        }else{
            $result = 2;
            return $result;
        }
        
        if(is_null($Key40)){
            $strSQL = " Where ReqNum IS NULL";
        }else{
            $strSQL = " Where ReqNum = :Key40";            
        }
        echo 'アクションタイプ確認ok';
        
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key40', $Key40, PDO::PARAM_STR);
           if($Key45=='true'){
               $stmh->bindParam(':Key45', -1, PDO::PARAM_STR);
           }else{
                $stmh->bindParam(':Key45', 0, PDO::PARAM_STR);                     
           }
           
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

    /**************リクエスト購入SQL*************************************************/
    function GETRequestPur($ActType, $Key1, $Key41, $Key46){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }
        
        if($Key1=='admin@10baton.com'){
            $strSQL = "UPDATE Request SET app = :Key46";
        }else{
            $result = 2;
            return $result;
        }
        
        if(is_null($Key40)){
            $strSQL = " Where ReqNum IS NULL";
        }else{
            $strSQL = " Where ReqNum = :Key40";            
        }
        echo 'アクションタイプ確認ok';
        
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key40', $Key40, PDO::PARAM_STR);
           if($Key45=='true'){
               $stmh->bindParam(':Key46', -1, PDO::PARAM_STR);
           }else{
                $stmh->bindParam(':Key46', 0, PDO::PARAM_STR);                     
           }
           
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