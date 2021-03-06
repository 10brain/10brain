<?php
require 'init.php';
//*****************************************************************************/
//
// 貸出・返却・リクエストSQL関連ファイル
// 20160119@ito
//
//*****************************************************************************/
class otherModel{

    /*********リクエスト未承認一覧SQL***************************************************/
    function GETRequest($ActType, $Key1, &$dspRequest){
        //初期値設定
        $result = 0;
        $key00 = 0;
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
        $strSQL = $strSQL." Where app='0'";
        //echo 'アクションタイプ確認ok';


        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           //$stmh->bindParam(':key', $key00, PDO::PARAM_INT);

            //echo $Key2.'確認';
            //echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           //echo 'DB接続ok';
           //echo $result;
           //echo $strSQL;
           $count=$stmh->rowCount();//実行結果の行数をカウント
           //echo $count;
           if($count == 0){
               //データなし
               $result = 0;
               //echo $count;
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


    /*********リクエスト未承認一覧SQL***************************************************/
    function GETRequestPur($ActType, $Key1, &$dspRequestPur){
        //初期値設定
        $result = 0;
        $key00 = 0;
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
        $strSQL = $strSQL." Where app=1 And pur='0' OR pur='2'";
        //echo 'アクションタイプ確認ok';
        //echo $key00;

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);


           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           //echo 'DB接続ok';
           //echo $result;
           //echo $strSQL;
           $count=$stmh->rowCount();//実行結果の行数をカウント
           //echo $count;
           if($count == 0){
               //データなし
               $result = 0;
             //  echo $count;
           }else{
                //表示データ収集
               $i=0;
                while($array = $stmh->fetch(PDO::FETCH_ASSOC)){
                   $dspRequestPur[$i][0] = $array['ReqNum'];//リクエスト番号
                   $dspRequestPur[$i][1] = $array['ReqTitle'];//リクエスト書籍タイトル
                   $dspRequestPur[$i][2] = $array['ReqDate'];//リクエスト登録日
                   $dspRequestPur[$i][3] = $array['app'];//承認
                   $dspRequestPur[$i][4] = $array['pur'];//購入
                   $dspRequestPur[$i][5] = $array['Num'];//リクエスト者社員番号
                   $dspRequestPur[$i][6] = $array['ReqAmaz'];//リクエストリンク
                   $dspRequestPur[$i][7] = $array['ReqRem'];//リクエスト備考
                   $dspRequestPur[$i][8] = $array['Name'];//社員名
                  $i=$i+1;
                }

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
        $strSQL = $strSQL." WHERE (app=1 and pur=1) OR (app=2 and pur=0)";
        $strSQL = $strSQL." ORDER BY ReqDate";
        //echo 'アクションタイプ確認ok';


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
           //echo 'DB接続ok';
           //echo $result;
           //echo $strSQL;
           $count=$stmh->rowCount();//実行結果の行数をカウント
           //echo $count;
           if($count == 0){
               //データなし
              // $result = 0;
              // echo $count;
           }else{
                //表示データ収集
               $i=0;
                while($array = $stmh->fetch(PDO::FETCH_ASSOC)){
                   $dspOldRequest[$i][0] = $array['ReqNum'];//リクエスト番号
                   $dspOldRequest[$i][1] = $array['ReqTitle'];//リクエスト書籍タイトル
                   $dspOldRequest[$i][2] = $array['ReqDate'];//リクエスト登録日
                    if($array['app'] == 1 AND $arry['pur'] == 1){
                        $dspOldRequest[$i][3] = $arry['pur'];
                    }else{
                        $dspOldRequest[$i][3] = $array['app'];
                    }
                   $dspOldRequest[$i][4] = $array['Num'];//リクエスト者社員番号
                   $dspOldRequest[$i][5] = $array['ReqAmaz'];//リクエストリンク
                   $dspOldRequest[$i][6] = $array['ReqRem'];//リクエスト備考
                   $dspOldRequest[$i][7] = $array['Name'];//社員名
                  $i=$i+1;
                }
               // print_r($dspOldRequest);
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
        //echo 'アクションタイプ確認ok';

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

           // echo $strSQL;
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
              // echo $count;
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
        //echo 'アクションタイプ確認ok';

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key61', $Key61, PDO::PARAM_STR);
           $stmh->bindParam(':Key62', $Key62, PDO::PARAM_STR);
           $stmh->bindParam(':Key63', $Key63, PDO::PARAM_STR);
           $stmh->bindParam(':Key0', $Key0, PDO::PARAM_STR);

           // echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           //echo 'DB接続ok';
           //echo $result;


        } catch (Exception $Exception) {
            $result = 3;
        }
        //return $dspUserInfo;
        return $result;
    }
    /**************リクエスト購入SQL*************************************************/
    function GETReqPur($Key1, $pur, $reqnum){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($Key1 != 'admin@10baton.com'){
            $result = 2;
            return $result;
        }

        //SQL実行
        try {
            $count = count($pur);

            for ($i=0; $i<=$count; $i++) {
                $strSQL = "UPDATE Request SET pur=:pur WHERE ReqNum=:reqnum";
                $class=new DBModel();
                $stmh = $class->pdo->prepare($strSQL);
                $stmh->bindParam(':pur', $pur[$i], PDO::PARAM_INT);
                $stmh->bindParam(':reqnum', $reqnum[$i], PDO::PARAM_STR);
                $stmh->execute();

            }

            //echo $strSQL;

           //$stmh->commit();
        } catch (Exception $Exception) {
           // echo $Exception;
                $result = 3;
        }

        //return $dspUserInfo;
        return $result;
    }

    /********リクエスト承認******************************************************/
    function GETReqApp($Key1, $app, $reqnum){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($Key1 != 'admin@10baton.com'){
            $result = 2;
            return $result;
        }
        //print_r($req['app']);
      //  print_r($req['num']);



        //echo 'アクションタイプ確認ok';

        //SQL実行
        try {


            $count = count($app);

            for ($i=0; $i<=$count; $i++) {
                $strSQL = "UPDATE Request SET app=:app WHERE ReqNum=:reqnum";
                $class=new DBModel();
                $stmh = $class->pdo->prepare($strSQL);
                $stmh->bindParam(':app', $app[$i], PDO::PARAM_INT);
                $stmh->bindParam(':reqnum', $reqnum[$i], PDO::PARAM_STR);
                $stmh->execute();

            }

            echo $strSQL;


           //$stmh->commit();
        } catch (Exception $Exception) {
            echo $Exception;
                $result = 3;
        }


        //return $dspUserInfo;
        return $result;
    }



}


?>
