<?php
require 'init.php';
//*****************************************************************************/
//
// ユーザー情報SQL関連ファイル
// 20160119@ito
//
//*****************************************************************************/
class UserModel{

    /*********ログインSQL*******************************************************/
    function GETLogin($ActType, $Key1, $Key2, &$dspUserInfo){
        //初期値設定
        $result = 0;
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
            $strSQL = $strSQL. " Where ID = :Key1 ";            
        }
        echo $Key1.'確認';
        
        //PW確認        
        if(is_null($Key2) == True){
            $strSQL = $strSQL. " And PW IS NULL";
        }else{
            $strSQL = $strSQL. " And PW = :Key2 ";            
        }
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key1', $Key1, PDO::PARAM_STR);
           $stmh->bindParam(':Key2', $Key2, PDO::PARAM_STR);
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
               $result = 1;
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
                   $dspUserInfo[2] = $array['PW'];//パスワード
                   
                   echo $dspUserInfo[0];
                   echo $dspUserInfo[1];
               }

           }
           
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }
    
    /*********ユーザー一覧情報SQL*************************************************/
    function GETUserList($ActType, &$dspUserList){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From User";
        }
        echo 'アクションタイプ確認ok';
        
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
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
                   $dspUserList[0] = $array['Num'];//社員番号
                   $dspUserList[1] = $array['Name'];//名前
                   $dspUserList[2] = $array['Num'];//社員番号
                   $dspUserList[3] = $array['Num'];//社員番号
                   

               }

           }
           
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }

    /*********ユーザ詳細SQL*******************************************************/
    function GETUserDetail($ActType, $Key12, &$dspUserDet){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From User";
        }
        echo 'アクションタイプ確認ok';
        
        //社員番号確認
        if(is_null($Key12) == True){
            $strSQL = $strSQL. " Where ID IS NULL";
        }else{
            $strSQL = $strSQL. " Where ID = :Key12 ";            
        }
        echo $Key1.'確認';
        
        //PW確認        
        if(is_null($Key2) == True){
            $strSQL = $strSQL. " And PW IS NULL";
        }else{
            $strSQL = $strSQL. " And PW = :Key2 ";            
        }
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key12', $Key12, PDO::PARAM_INT);
  
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
               //データ取得
               $array = $stmh->fetch(PDO::FETCH_ASSOC);
               if($array == false){
                   //システムエラー
                   $result = 2;
               }else{
                   //表示データ収集
                   $dspUserDet[0] = $array['Num'];//社員番号
                   $dspUserDet[1] = $array['ID'];//名前
                   $dspUserDet[2] = $array['PW'];//名前
                   $dspUserDet[3] = $array['Name'];//名前

               }

           }
           
        } catch (Exception $Exception) {
            $result = 2;
        }

        return $result;
    }

    /*********ユーザー登録SQL*************************************************/
    function GETUserAdd($ActType, $Key1, $Key51, $Key52){
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
            
            $strSQL = "INSERT INTO User(ID, Name) VALUES (:Key52, :Key51)";
        }
        echo 'アクションタイプ確認ok';
        
        //SQL実行
        try {
            $Key52 = $Key52.'@10baton.com';
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key51', $Key51, PDO::PARAM_STR);
           $stmh->bindParam(':Key52', $Key52, PDO::PARAM_STR);

            echo $strSQL;

           $stmh->execute();//実行

           if(!$stmh){
               //システムエラー
               $result=3;
           }
           echo $result;
           echo 'DB接続ok';
           

           
        } catch (Exception $Exception) {
            $result=3;
        }
        
        return $result;
    }


    /*********ユーザーパスワード変更QL*************************************************/
    function GETUserPassEdit($ActType, $Key1, $Key2, $newpass){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($ActType != 'TgRSPInf'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "UPDATE User SET PW = :newpass";
        }
        echo 'アクションタイプ確認ok';
        
        
        //ID確認        
        if(is_null($Key1) == True){
            $strSQL = $strSQL. " Where ID IS NULL";
        }else{
            $strSQL = $strSQL. " Where ID = :Key1 ";            
        }
 
        //PW確認        
        if(is_null($Key2) == True){
            $strSQL = $strSQL. " And PW IS NULL";
        }else{
            $strSQL = $strSQL. " And PW = :Key2 ";            
        }

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key1', $Key1, PDO::PARAM_STR);
           $stmh->bindParam(':Key2', $Key2, PDO::PARAM_STR);
           $stmh->bindParam(':newpass', $newpass, PDO::PARAM_STR);

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

    /*********ユーザーパスワード初期化SQL******************************************/
    function GETUserPassIni($ActType, $Key1, $Key16){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($Key1 != 'admin@10baton.com'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "UPDATE User SET PW = :Key17";
        }
        echo 'アクションタイプ確認ok';
        
        
        //ID確認        
        if(is_null($Key16) == True){
            $strSQL = $strSQL. " Where PW IS NULL";
        }else{
            $strSQL = $strSQL. " Where PW = :Key16";            
        }
 

        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key16', $Key16, PDO::PARAM_STR);
           $stmh->bindParam(':Key17', $Key17, PDO::PARAM_INT);

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