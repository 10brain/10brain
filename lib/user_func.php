<?php
require 'init.php';
//*****************************************************************************/
//
// ユーザー情報関連ファイル
// 20160119@ito
//
//*****************************************************************************/
class UserModel{
    function GETLogin($ActType, $Key1, $Key2, &$dspUserInfo){
        //初期値設定
        $result = 0;
        $ret = [];
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From User";
        }
        echo 'アクションタイプ確認ok';
        
        //ID確認
        if(is_null($Key1) == True){
            $strSQL = $strSQL. " Where ID IS NULL";
        }else{
            $strSQL = $strSQL. " Where ID = :Key1";            
        }
        echo $Key1.'確認';
        
        //PW確認        
        if(is_null($Key2) == True){
            $strSQL = $strSQL. " And PW IS NULL";
        }else{
            $strSQL = $strSQL. " And PW = :Key1";            
        }
        echo $Key2.'確認';
        echo $strSQL;
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo($strSQL);
           $stmh->bindValue(':Key1', $Key1, PDO::PARAM_STR);
           $stmh->bindValue(':Key2', $Key2, PDO::PARAM_STR);
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
               $result = 3;
               echo $count;
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
                   
                   echo $dspUserInfo[0];
                   echo $dspUserInfo[1];
               }

           }
           
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }
}


?>