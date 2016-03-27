<?php
require 'init.php';
//*****************************************************************************/
//
// 貸出・返却・リクエストSQL関連ファイル
// 20160119@ito
//
//*****************************************************************************/
class otherModel{
    /*********トップ用SQL*******************************************************/
    function GETTopLogin($ActType, $Key1, $Key2, &$dspUserInfo, &$dspBookNewList){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }


        /*echo 'アクションタイプ確認ok';*/
        //SQL実行
        try {
            $strSQL = "Select * From User";
            //ID確認
            if(is_null($Key1) == True){

                $strSQL = $strSQL. " Where ID IS NULL";
            }else{
                $strSQL = $strSQL. " Where ID = :Key1 ";
            }
            /*echo $Key1.'確認';*/

            //PW確認
            if(is_null($Key2) == True){
                $strSQL = $strSQL. " And PW IS NULL";
            }else{
                $strSQL = $strSQL. " And PW = :Key2 ";
            }

           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key1', $Key1, PDO::PARAM_STR);
           $stmh->bindParam(':Key2', $Key2, PDO::PARAM_STR);
            //echo $Key2.'確認';
            //echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           //echo 'DB接続ok';


           $count=$stmh->rowCount();//実行結果の行数をカウント
           if($count == 0){
               //データなし
               $result = 1;
               //echo $count;
           }else{
               //データ取得
               $array = $stmh->fetch(PDO::FETCH_ASSOC);
               if($array == false){
                   //システムエラー
                   $result = 2;
               }else{
                   //表示データ収集
                   $dspUserInfo[0] = $array['Num'];//社員番号
                   $dspUserInfo[1] = $array['Name'];//名前
                   $dspUserInfo[2] = $array['PW'];//パスワード
                   //echo $result;
                   /*echo $dspUserInfo[0];
                   echo $dspUserInfo[1];*/
               }

           }
            $strSQL = "Select * From Book INNER JOIN cover ON cover.ISBN = Book.ISBN";

            //echo $Key21;

            $strSQL = $strSQL." ORDER BY Book.date DESC LIMIT 30";


           //クラス呼び出し
           //$class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
            //$stmh->bindParam(':Key21', $Key21, PDO::PARAM_STR);

            //echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           //echo 'DB接続ok';
           //echo $result;

           $count=$stmh->rowCount();//実行結果の行数をカウント
           if($count == 0){
               //データなし
               $result = 0;
               //echo $count;
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

        } catch (Exception $Exception) {


        }
        //return $dspUserInfo;

        ///
        //return $dspUserInfo;
        return $result;

    }



    /*********リクエスト未承認一覧SQL***************************************************/
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
            $strSQL = "Select * From Request INNER JOIN User ON User.Num = Request.Num";
        }else{
            $result = 2;
            return $result;
        }
        $strSQL = $strSQL." Where app IS NULL";
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
           echo $strSQL;
           $count=$stmh->rowCount();//実行結果の行数をカウント
           echo $count;
           if($count == 0){
               //データなし
               $result = 0;
               echo $count;
           }else{
                //表示データ収集
               $i=0;
                while($array = $stmh->fetch(PDO::FETCH_ASSOC)){
                   $dspRequest[$i][0] = $array['ReqNum'];//リクエスト番号
                   $dspRequest[$i][1] = $array['ReqTitle'];//リクエスト書籍タイトル
                   $dspRequest[$i][2] = $array['ReqDate'];//リクエスト登録日
                   $dspRequest[$i][3] = $array['app'];//承認
                   $dspRequest[$i][4] = $array['pur'];//購入
                   $dspRequest[$i][5] = $array['Num'];//リクエスト者社員番号
                   $dspRequest[$i][6] = $array['ReqAmaz'];//リクエストリンク
                   $dspRequest[$i][7] = $array['ReqRem'];//リクエスト備考
                   $dspRequest[$i][8] = $array['Name'];//社員名
                  $i=$i+1;
                }
               // print_r($dspRequest);
           }

        } catch (Exception $Exception) {
            $result = 3;
        }
        //return $dspUserInfo;
        return $result;
    }

        /*********過去リクエスト一覧SQL***************************************************/
    function GETOldRequest($ActType, $Key1, &$dspOldRequest){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }
        if(!is_null($Key1)){
            $strSQL = "Select * From Request INNER JOIN User ON User.Num = Request.Num";

        }else{
            $result = 2;
            return $result;
        }
        $strSQL = $strSQL." Where app IS NOT NULL AND pur IS NOT NULL";
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
           echo $strSQL;
           $count=$stmh->rowCount();//実行結果の行数をカウント
           echo $count;
           if($count == 0){
               //データなし
               $result = 0;
               echo $count;
           }else{
                //表示データ収集
               $i=0;
                while($array = $stmh->fetch(PDO::FETCH_ASSOC)){
                   $dspOldRequest[$i][0] = $array['ReqNum'];//リクエスト番号
                   $dspOldRequest[$i][1] = $array['ReqTitle'];//リクエスト書籍タイトル
                   $dspOldRequest[$i][2] = $array['ReqDate'];//リクエスト登録日
                   $dspOldRequest[$i][3] = $array['app'];//承認
                   $dspOldRequest[$i][4] = $array['pur'];//購入
                   $dspOldRequest[$i][5] = $array['Num'];//リクエスト者社員番号
                   $dspOldRequest[$i][6] = $array['ReqAmaz'];//リクエストリンク
                   $dspOldRequest[$i][7] = $array['ReqRem'];//リクエスト備考
                   $dspOldRequest[$i][8] = $array['Name'];//社員名
                  $i=$i+1;
                }
                print_r($dspOldRequest);
           }

        } catch (Exception $Exception) {
            $result = 3;
        }
        //return $dspUserInfo;
        return $result;
    }


    /*********リクエスト詳細SQL*************************************************/
    function GETRequestDetail($ActType, $Key1, $Key40, &$dspOldRequestDet){
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
    function GETRequestAdd($ActType, $Key0, $Key61, $Key62, $Key63){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "INSERT INTO Request(Reqtitle, Reqamaz, ReqRem, ReqDate, Num) VALUES";
            $strSQL = $strSQL. " (:Key61, :Key62, :Key63, '" .Date('Ymd') ."', :Key0)";
        }
        echo 'アクションタイプ確認ok';

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key61', $Key61, PDO::PARAM_STR);
           $stmh->bindParam(':Key62', $Key62, PDO::PARAM_STR);
           $stmh->bindParam(':Key63', $Key63, PDO::PARAM_STR);
           $stmh->bindParam(':Key0', $Key0, PDO::PARAM_STR);

            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;


        } catch (Exception $Exception) {
            $result = 3;
        }
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
            $strSQL = "UPDATE Request SET app = case RepNum";
        }else{
            $result = 2;
            return $result;
        }

        if(!is_null($Key60) and !is_null($Key61)){
            foreach ($data as $Key60 => $Key61) {
                $strSQL .= ' WHEN '.':Key60'.' THEN '.':Key61';
            }
            $strSQL .= ' END';
        }else{
            $result = 4;
            return $result;
        }
        echo 'アクションタイプ確認ok';

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key60', $Key60, PDO::PARAM_INT);
           $stmh->bindParam(':Key61', $Key61, PDO::PARAM_STR);

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
    /********リクエスト承認******************************************************/
    /*function GETRequestApp($ActType, $Key0, $Key61, $Key62, $Key63){
        //初期値設定
        $result = 0;
        /**SQL発行**
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }
            //$i =0;
            /*$strSQL = "INSERT INTO Request(Reqtitle, Reqamaz, ReqRem, ReqDate, Num) VALUES";
            $strSQL = $strSQL. " (:Key61, :Key62, :Key63, '" .Date('Ymd') ."', :Key0)";
        
        echo 'アクションタイプ確認ok';

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key61', $Key61, PDO::PARAM_STR);
           $stmh->bindParam(':Key62', $Key62, PDO::PARAM_STR);
           $stmh->bindParam(':Key63', $Key63, PDO::PARAM_STR);
           $stmh->bindParam(':Key0', $Key0, PDO::PARAM_STR);

            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           echo 'DB接続ok';
           echo $result;


        } catch (Exception $Exception) {
            $result = 3;
        }
        //return $dspUserInfo;
        return $result;
    }
        */


}


?>
