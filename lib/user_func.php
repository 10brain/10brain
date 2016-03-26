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
        /*echo 'アクションタイプ確認ok';*/

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
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key1', $Key1, PDO::PARAM_STR);
           $stmh->bindParam(':Key2', $Key2, PDO::PARAM_STR);
            /*echo $Key2.'確認';
            echo $strSQL;*/

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=2;
           }
           /*echo 'DB接続ok';
           echo $result;*/

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

                   /*echo $dspUserInfo[0];
                   echo $dspUserInfo[1];*/
               }

           }
            $stmh = null;
        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;

    }

    /*********ユーザ詳細SQL*******************************************************/
    function GETUserDetail($ActType, $Key12, $Key13, &$dspUserDet){
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
            $strSQL = $strSQL. " Where Num IS NULL";
        }else{
            $strSQL = $strSQL. " Where Num = :Key12";
        }
        //ID
        if(is_null($Key13) == True){
            $strSQL = $strSQL. " And ID IS NULL";
        }else{
            $strSQL = $strSQL. " And ID = :Key13 ";
        }


        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key12', $Key12, PDO::PARAM_INT);
           $stmh->bindParam(':Key13', $Key13, PDO::PARAM_STR);

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

            $strSQL = "INSERT INTO User(ID, Name, PW) VALUES (:Key52, :Key51, :Key53)";
        }
        echo 'アクションタイプ確認ok';

        //SQL実行
        try {
            $Key52 = $Key52.'@10baton.com';
            $pw = 9999;
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key51', $Key51, PDO::PARAM_STR);
           $stmh->bindParam(':Key52', $Key52, PDO::PARAM_STR);
           $stmh->bindParam(':Key53', $pw, PDO::PARAM_INT);

            echo $strSQL;

           $stmh->execute();//実行

           if(!$stmh){
               //システムエラー
               $result=3;
           }
           /*echo $result;
           echo 'DB接続ok';*/



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

    /*********ユーザー編集SQL******************************************/
    function GETUserEdit($ActType, $Key1, $Key12, $Key13, $Key14, $Key15){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($Key1 != 'admin@10baton.com'){
            $result = 2;
            return $result;
        }
        $strSQL = "UPDATE User SET";

        if(isset($Key13)){
            $strSQL = $strSQL." Name = :Key13";
        }
        if(isset($Key14)){
            $strSQL = $strSQL.", ID = :Key14";
        }

        if($Key15 == '9999'){
            $strSQL = $strSQL.", PW = :Key15";
        }
        echo 'アクションタイプ確認ok';


        //条件
        if(is_null($Key12) == True){
            $strSQL = $strSQL. " Where Num IS NULL";
        }else{
            $strSQL = $strSQL. " Where Num = :Key12";
        }


        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key12', $Key12, PDO::PARAM_STR);
           $stmh->bindParam(':Key13', $Key13, PDO::PARAM_STR);
           $stmh->bindParam(':Key14', $Key14, PDO::PARAM_STR);
           if($Key15=='9999'){
            $stmh->bindParam(':Key15', $Key15, PDO::PARAM_STR);
           }
            echo $strSQL;

           $stmh->execute();//実行
           if(!$stmh){
               //システムエラー
               $result=3;
           }
           echo 'DB接続ok';
           echo $result;

        } catch (Exception $Exception) {
            $result=3;
        }
        //return $dspUserInfo;
        return $result;
    }

    /*********管理者ユーザー検索SQL*************************************************/
    function GETAdminUser($ActType, $Key1, $Key11, &$dspAdminUser){
        //初期値設定
        $result = 0;
        /**SQL発行**/
        //アクションタイプ確認
        if($Key1 != 'admin@10baton.com'){
            $result = 2;
            return $result;
        }else{
            $strSQL = "Select * From User";
        }
        echo 'アクションタイプ確認ok';

        //書籍番号確認
        if($Key11){
            $strSQL = $strSQL. ' WHERE Name Like :Key11';
        }
        $Key11 = "%$Key11%";
echo $Key11;
echo $result;
        //SQL実行
        try {
           //クラス呼び出し
           $class=new DBModel();
           $stmh = $class->pdo->prepare($strSQL);
           $stmh->bindParam(':Key11', $Key11, PDO::PARAM_STR);


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
                   $dspAdminUser[$i][0] = $array['Num'];//社員番号
                   $dspAdminUser[$i][1] = $array['ID'];//ID
                   $dspAdminUser[$i][2] = $array['Name'];//名前
                  $i=$i+1;
               }

           }

        } catch (Exception $Exception) {}
        //return $dspUserInfo;
        return $result;
    }




}


?>
