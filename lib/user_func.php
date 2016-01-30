<?php
require 'init.php';
//*****************************************************************************/
//
// ユーザー情報関連ファイル
// 20160119@ito
//
//*****************************************************************************/
class UserModel extends DBModel{
    function GETLogin($ActType, $Key1, $Key2, &$dspUserInfo){
        //初期値設定
        $result = 0;
        $ret = [];
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSinf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From User";
        }

        //ID確認
        if(is_null($Key1) == True){
            $strSQL = $strSQL. " Where ID IS NULL";
        }else{
            $strSQL = $strSQL. " Where ID = :Key1";            
        }

        //PW確認        
        if(is_null($Key2) == True){
            $strSQL = $strSQL. " And PW IS NULL";
        }else{
            $strSQL = $strSQL. " And PW = :Key1";            
        }

        //SQL実行
        try {
           $stmh = $this->pdo->prepare($strSQL);
           $stmh->bindValue(':Key1', $Key1, PDO::PARAM_STR);
           $stmh->bindValue(':Key2', $Key2, PDO::PARAM_STR);
           $stmh->execute();//実行
           if($stmh==false){
               //システムエラー
               $result=2;
           }
           
           $count=$stmh->rowCount();//実行結果の行数をカウント
           if($count == 0){
               //データなし
               $result = 0;
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
                   
               }
           }
           
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }
}


?>